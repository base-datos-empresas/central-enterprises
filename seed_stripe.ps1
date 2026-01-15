$ErrorActionPreference = "Stop"

# Configuration
$SecretKey = "sk_live_..."
$Headers = @{
    "Authorization" = "Bearer $SecretKey"
    "Content-Type"  = "application/x-www-form-urlencoded"
}

# Data
$MasterPrices = @{
    'US' = 1290; 'GB' = 990; 'DE' = 990; 'CH' = 990; 'NO' = 990;
    'FR' = 790; 'ES' = 790; 'BR' = 790; 'IT' = 590; 'CA' = 590;
    'AU' = 590; 'NL' = 590; 'BE' = 490; 'PL' = 490; 'ID' = 390;
    'PT' = 290; 'RO' = 290; 'AT' = 290; 'MY' = 290; 'IE' = 290;
    'LT' = 190
}

$GlobalPlans = @{
    'agency_global'    = @{ 'name' = 'Agency Global License'; 'amount' = 3900 };
    'enterprise_base'  = @{ 'name' = 'Enterprise Base'; 'amount' = 14000 };
    'enterprise_plus'  = @{ 'name' = 'Enterprise Plus'; 'amount' = 18000 };
    'enterprise_ultra' = @{ 'name' = 'Enterprise Ultra'; 'amount' = 25000 }
}

$Results = @{}

function Create-Price {
    param ($Name, $AmountEur, $Interval, $Key)
    
    Write-Host "Creating $Name..."
    
    # 1. Create Product
    try {
        $ProdBody = @{ name = $Name }
        $Prod = Invoke-RestMethod -Uri "https://api.stripe.com/v1/products" -Method Post -Headers $Headers -Body $ProdBody
        $ProdId = $Prod.id
    }
    catch {
        Write-Error "Failed to create product $Name : $_"
        return
    }

    # 2. Create Price
    $AmountCents = [math]::Round($AmountEur * 100)
    $PriceBody = @{
        "product"     = $ProdId
        "unit_amount" = $AmountCents
        "currency"    = "eur"
    }
    
    if ($Interval) {
        $PriceBody["recurring[interval]"] = $Interval
    }
    
    try {
        $Price = Invoke-RestMethod -Uri "https://api.stripe.com/v1/prices" -Method Post -Headers $Headers -Body $PriceBody
        $PriceId = $Price.id
        
        # Add to results
        $Script:Results[$Key] = $PriceId
        Write-Host "SUCCESS: $Key => $PriceId"
    }
    catch {
        Write-Error "Failed to create price for $Name : $_"
    }
}

Write-Host "--- STARTING STRIPE SEEDING (PowerShell) ---"

# 1. Global Plans
Write-Host "`n--- GLOBAL PLANS ---"
foreach ($key in $GlobalPlans.Keys) {
    $plan = $GlobalPlans[$key]
    Create-Price -Name $plan.name -AmountEur $plan.amount -Interval "year" -Key $key
}

# 2. Country PRO
Write-Host "`n--- COUNTRY PLANS (PRO) ---"
foreach ($iso in $MasterPrices.Keys) {
    $price = $MasterPrices[$iso]
    $name = "Pro Country License - $iso"
    $key = "pro_" + $iso.ToLower()
    Create-Price -Name $name -AmountEur $price -Interval "year" -Key $key
}

# 3. Country STARTER
Write-Host "`n--- COUNTRY PLANS (STARTER) ---"
foreach ($iso in $MasterPrices.Keys) {
    $price = $MasterPrices[$iso]
    $name = "Starter License (90D) - $iso"
    $key = "starter_" + $iso.ToLower()
    # Starter is One-Time One-Third
    $starterPrice = [math]::Round($price / 3, 2)
    Create-Price -Name $name -AmountEur $starterPrice -Interval $null -Key $key
}

Write-Host "`n`n--- CONFIG PHP ARRAY ---"
Write-Host "define('STRIPE_PRICES', ["
foreach ($k in $Results.Keys) {
    Write-Host "    '$k' => '$($Results[$k])',"
}
Write-Host "]);"
