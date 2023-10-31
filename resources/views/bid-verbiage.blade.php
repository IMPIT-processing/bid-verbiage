<!DOCTYPE html>
<html>

<head>
    <title>Bid Verbiage</title>
    @if(isset($_GET['clientCode']))
    @if($_GET['clientCode'] === '1')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/unique_preservation.css') }}">
    @php
    $logoImage = 'images/unique_logo.PNG';
    $nameImage = 'images/unique_name.PNG';
    @endphp
    @elseif($_GET['clientCode'] === '2')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/planners_solution.css') }}">
    @php
    $logoImage = 'images/planners_logo.png';
    $nameImage = 'images/planners_name.PNG';
    @endphp
    @elseif($_GET['clientCode'] === '3')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/secure_asset_management.css') }}">
    @php
    $logoImage = 'images/secure_logo.png';
    $nameImage = 'images/secure_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '4')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/brollex.css') }}">
    @php
    $logoImage = 'images/brollex_logo.png';
    $nameImage = 'images/brollex_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '5')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/effcy.css') }}">
    @php
    $logoImage = 'images/effcy_logo.png';
    $nameImage = 'images/effcy_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '6')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cardinal_asset_management.css') }}">
    @php
    $logoImage = 'images/cardinal_logo.png';
    $nameImage = 'images/cardinal_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '8')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sn_field_services_inc.css') }}">
    @php
    $logoImage = 'images/sn_logo.png';
    $nameImage = 'images/sn_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '9')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/quality_home_maintenance.css') }}">
    @php
    $logoImage = 'images/quality_logo.png';
    $nameImage = 'images/quality_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '10')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rite_option_preservation.css') }}">
    @php
    $logoImage = 'images/rite_logo.png';
    $nameImage = 'images/rite_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '11')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/care_guard_preservation.css') }}">
    @php
    $logoImage = 'images/care_logo.png';
    $nameImage = 'images/care_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '13')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/heaven_property_management.css') }}">
    @php
    $logoImage = 'images/heaven_logo.png';
    $nameImage = 'images/heaven_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '14')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_tech_preservation.css') }}">
    @php
    $logoImage = 'images/home_logo.png';
    $nameImage = 'images/home_name.png';
    @endphp
    @elseif($_GET['clientCode'] === '15')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assurance_field_service.css') }}">
    @php
    $logoImage = 'images/assurance_logo.png';
    $nameImage = 'images/assurance_name.png';
    @endphp
    @endif
    @endif
</head>

<body>
    <div class="receipt">
        <div class="company-info">
            @if(isset($logoImage) && isset($nameImage))
            <img class="company-logo" src="{{ asset($logoImage) }}" alt="Company Logo">
            <img class="company-name" src="{{ asset($nameImage) }}" alt="Company Name">
            @endif
        </div>
        <div class="content">
            <div class="additional-info" id="additional-info">
                <!-- Additional information will be dynamically inserted here -->
            </div>

            <div class="property-info"><strong>Workorder# </strong><span id="work-order-number">[Work Order Number]</span></div>
            <div class="property-info"><strong>Property Address: </strong> <span id="property-address">[Property Address]</span></div>

            <div class="line-before"></div>
            <div class="scope-of-work"><strong>Scope of Work</strong></div>
            <div class="line-after"></div>

            <div class="margin-align">
                <div class="product">
                    <ul id="product-list">
                        <!-- Product details will be dynamically inserted here using JavaScript -->
                    </ul>
                </div>
                <div class="total">Total: $<span id="total-amount">[Insert Total Here]</span></div>

                <div class="print-button">
                    <button onclick="printReceipt()">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const receivedData = urlParams.get('data');
        const propertyAddress = urlParams.get('property-address');
        const workOrderNumber = urlParams.get('wo-number');

        if (receivedData) {
            const products = JSON.parse(decodeURIComponent(receivedData));
            const productList = document.getElementById("product-list");
            let total = 0;

            products.forEach((product, index) => {
                const listItem = document.createElement("li");
                let actionDescription = '';

                // Creating the action description based on the Scope of Work
                if (product.actionPerform === "Trim Medium Tree") {
                    actionDescription = `Trim (${product.quantity}) 9-18-inch diameter and up to 16 feet small tree located at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Trim Small Tree") {
                    actionDescription =
                        `Trim (${product.quantity}) 8-inch diameter and up to 16 feet small tree locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Trim Medium Tree") {
                    actionDescription =
                        `Trim (${product.quantity}) 9-18-inch diameter and up to 16 feet small tree locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Trim Large Tree") {
                    actionDescription =
                        `Trim (${product.quantity}) 9-18-inch diameter and up to 16 feet small tree locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Trim Extra Large Tree") {
                    actionDescription =
                        `Trim (${product.quantity}) 9-18-inch diameter and up to 16 feet small tree locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Trim Trees") {
                    actionDescription =
                        `Trim (${product.quantity}) 9-18-inch diameter and up to 16 feet small tree locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Remove Saplings") {
                    actionDescription =
                        `Remove approx. (${product.quantity}) locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Remove Exterior Debris") {
                    actionDescription =
                        `Remove approx. (${product.quantity}) ${product.unit} locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Remove Interior Debris") {
                    actionDescription =
                        `Remove approx. (${product.quantity}) ${product.unit} locating at the ${product.location} of the property.`;
                } else if (product.actionPerform === "Change Locks") {
                    actionDescription =
                        `Remove and replace (${product.quantity}) locating at the ${product.location} of the property.`;
                }

                let disclaimerText = product.disclaimer.trim() !== '' ? `<strong>** ${product.disclaimer} **</strong><br><br>` : '';

                listItem.innerHTML = `<strong>${index + 1}. ${product.actionPerform}:</strong> ${actionDescription}
                                      <strong>Price: $${product.totalCost.toFixed(2)}</strong><br><br>
                                      ${disclaimerText}`; // Including the disclaimer here
            
                productList.appendChild(listItem);
                total += product.totalCost;
            });

            document.querySelector("#total-amount").textContent = total.toFixed(2);
        }

        if (propertyAddress) {
            document.querySelector("#property-address").textContent = propertyAddress;
        }

        if (workOrderNumber) {
            document.querySelector("#work-order-number").textContent = workOrderNumber;
        }

        function printReceipt() {
            window.print();
        }

    </script>
</body>
</html>