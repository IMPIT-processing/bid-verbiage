<!DOCTYPE html>
<html>

<head>
    <title>Bid Verbiage Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Bid Verbiage Generator</h1>

        <div class="row mt-5">
            <div class="col-md-4">
                <label for="client-code" class="form-label">Client Code:</label>
                <input type="number" class="form-control" id="client-code">
            </div>
            <div class="col-md-4">
                <label for="wo-number" class="form-label">W/O Number:</label>
                <input type="text" class="form-control" id="wo-number">
            </div>
            <div class="col-md-4">
                <label for="property-address" class="form-label">Property Address:</label>
                <input type="text" class="form-control" id="property-address">
            </div>
        </div>

        <div id="product-details" class="mt-5">
            <h2>Product Details</h2>
            <table class="table table-bordered product-table">
                <thead>
                    <tr>
                        <th>Scope of Work</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Cost per Unit ($)</th>
                        <th>Total Cost ($)</th>
                        <th>Location</th>
                        <th>Disclaimer</th>
                    </tr>
                </thead>
                <tbody id="product-rows">
                    <tr>
                        <td>
                            <select class="form-select action-perform" onchange="updateTotalCost(this)">
                                <option value="#"></option>
                                <option value="Trim Shrubs">Trim Shrubs</option>
                                <option value="Trim Small Tree">Trim Small Tree</option>
                                <option value="Trim Medium Tree">Trim Medium Tree</option>
                                <option value="Trim Large Tree">Trim Large Tree</option>
                                <option value="Trim Extra Large Tree">Trim Extra Large Tree</option>
                                <option value="Trim Trees">Trim Trees</option>
                                <option value="Remove Saplings">Remove Saplings</option>
                                <option value="Remove Exterior Debris">Remove Exterior Debris</option>
                                <option value="Remove Interior Debris">Remove Interior Debris</option>
                                <option value="Change Locks">Change Locks</option>
                            </select>
                        </td>
                        <td><input type="number" class="form-control quantity" oninput="updateTotalCost(this)"></td>
                        <td>
                            <select class="form-select unit" onchange="updateTotalCost(this)">
                                <option value="Linear Feet">Linear Feet</option>
                                <option value="Each">Each</option>
                                <option value="Cubic Yard">Cubic Yard</option>
                                <option value="Square Feet">Square Feet</option>
                            </select>
                        </td>
                        <td><input type="number" class="form-control cost-per-unit" oninput="updateTotalCost(this)"></td>
                        <td class="total-cost">0.00</td>
                        <td><input type="text" class="form-control location"></td>
                        <td><input type="text" class="form-control disclaimer" onclick="openDisclaimerModal(this)"></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" onclick="addProductRow()">Add Product</button>
        </div>

        <a href="bid-verbiage.blade.php" id="preview-link" class="btn btn-success mt-4" target="_blank" onclick="passDataToPreview()">Preview and Print</a>
    </div>

    <div class="modal" id="disclaimerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Disclaimer Text</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeDisclaimerModal()"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="disclaimerTextArea" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveDisclaimerText()">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeDisclaimerModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addProductRow() {
            const tbody = document.getElementById('product-rows');
            const newRow = tbody.insertRow();
            newRow.innerHTML = `
                <td>
                    <select class="form-select action-perform" onchange="updateTotalCost(this)">
                        <option value="#"></option>
                        <option value="Trim Shrubs">Trim Shrubs</option>
                        <option value="Trim Small Tree">Trim Small Tree</option>
                        <option value="Trim Medium Tree">Trim Medium Tree</option>
                        <option value="Trim Large Tree">Trim Large Tree</option>
                        <option value="Trim Extra Large Tree">Trim Extra Large Tree</option>
                        <option value="Trim Trees">Trim Trees</option>
                        <option value="Remove Saplings">Remove Saplings</option>
                        <option value="Remove Exterior Debris">Remove Exterior Debris</option>
                        <option value="Remove Interior Debris">Remove Interior Debris</option>
                        <option value="Change Locks">Change Locks</option>
                    </select>
                </td>
                <td><input type="number" class="form-control quantity" oninput="updateTotalCost(this)"></td>
                <td>
                    <select class="form-select unit" onchange="updateTotalCost(this)">
                        <option value="Linear Feet">Linear Feet</option>
                        <option value="Each">Each</option>
                        <option value="Cubic Yard">Cubic Yard</option>
                        <option value="Square Feet">Square Feet</option>
                    </select>
                </td>
                <td><input type="number" class="form-control cost-per-unit" oninput="updateTotalCost(this)"></td>
                <td class="total-cost">0.00</td>
                <td><input type="text" class="form-control location"></td>
                <td><input type="text" class="form-control disclaimer" onclick="openDisclaimerModal(this)"></td>
            `;
        }

        function openDisclaimerModal(element) {
            const disclaimerModal = new bootstrap.Modal(document.getElementById('disclaimerModal'));
            disclaimerModal.show();

            const disclaimerText = element.value;
            document.getElementById('disclaimerTextArea').value = disclaimerText;

            // Store the row index of the clicked disclaimer input
            const rowIndex = Array.from(document.querySelectorAll('.disclaimer')).indexOf(element);
            document.getElementById('disclaimerTextArea').setAttribute('data-row-index', rowIndex);
        }

        function saveDisclaimerText() {
            const disclaimerText = document.getElementById('disclaimerTextArea').value;
            const rowIndex = document.getElementById('disclaimerTextArea').getAttribute('data-row-index');
            const disclaimerInputs = document.querySelectorAll('.disclaimer');

            disclaimerInputs[rowIndex].value = disclaimerText;

            const disclaimerModal = new bootstrap.Modal(document.getElementById('disclaimerModal'));
            disclaimerModal.hide();
        }

        function closeDisclaimerModal() {
            const disclaimerModal = new bootstrap.Modal(document.getElementById('disclaimerModal'));
            disclaimerModal.hide();
        }

        function updateTotalCost(element) {
            const row = element.closest('tr');
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const costPerUnit = parseFloat(row.querySelector('.cost-per-unit').value) || 0;
            const totalCost = quantity * costPerUnit;
            row.querySelector('.total-cost').textContent = totalCost.toFixed(2);
        }

        function passDataToPreview() {
            const productRows = document.querySelectorAll('.product-table tbody tr');
            const productData = [];

            productRows.forEach(row => {
                const actionPerform = row.querySelector('.action-perform').value;
                const quantity = parseFloat(row.querySelector('.quantity').value);
                const unit = row.querySelector('.unit').value;
                const costPerUnit = parseFloat(row.querySelector('.cost-per-unit').value);
                const totalCost = quantity * costPerUnit;
                const location = row.querySelector('.location').value;
                const disclaimer = row.querySelector('.disclaimer').value;

                if (actionPerform && !isNaN(quantity) && unit && !isNaN(costPerUnit) && location) {
                    productData.push({
                        actionPerform,
                        quantity,
                        unit,
                        costPerUnit,
                        totalCost,
                        location,
                        disclaimer,
                    });
                }
            });

            const data = encodeURIComponent(JSON.stringify(productData));
            const propertyAddress = document.getElementById("property-address").value;
            const workOrderNumber = document.getElementById("wo-number").value;
            const clientCode = document.getElementById("client-code").value;
            const previewLink = document.getElementById("preview-link");
            previewLink.href = `/preview?data=${data}&property-address=${propertyAddress}&wo-number=${workOrderNumber}&clientCode=${clientCode}`;
        }
    </script>
</body>
</html>
