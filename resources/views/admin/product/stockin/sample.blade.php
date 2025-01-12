@extends('layouts.app')

@section('content')
    <h1>Add Stock-In</h1>
    <form id="stockInForm" action="{{ route('stock-ins.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="model_id" class="form-label">Product Model</label>
            <select class="form-control" id="model_id" name="model_id" required>
                <option value="">Select Model</option>
                @foreach($walkieTalkies as $walkieTalkie)
                    <option value="{{ $walkieTalkie->id }}">{{ $walkieTalkie->model->name }} (Serial: {{ $walkieTalkie->serial_number }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="addItem()">Add Item</button>
        <hr>

        <!-- List of Added Items -->
        <h3>Items to Add</h3>
        <table class="table table-bordered" id="itemsTable">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Serial Number</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Items will be added here dynamically -->
            </tbody>
        </table>

        <!-- Hidden input to store the items data -->
        <input type="hidden" name="items" id="itemsInput">

        <button type="submit" class="btn btn-success">Submit All Items</button>
    </form>

    <script>
        // Array to store added items
        let items = [];

        // Function to add an item to the list
        function addItem() {
            const modelId = document.getElementById('model_id').value;
            const modelText = document.getElementById('model_id').options[document.getElementById('model_id').selectedIndex].text;
            const quantity = document.getElementById('quantity').value;
            const date = document.getElementById('date').value;

            if (!modelId || !quantity || !date) {
                alert('Please fill all fields.');
                return;
            }

            // Add item to the array
            items.push({
                model_id: modelId,
                model_text: modelText,
                quantity: quantity,
                date: date
            });

            // Update the table
            updateTable();

            // Clear the form fields
            document.getElementById('model_id').value = '';
            document.getElementById('quantity').value = '';
            document.getElementById('date').value = '';
        }

        // Function to update the table with added items
        function updateTable() {
            const tableBody = document.querySelector('#itemsTable tbody');
            tableBody.innerHTML = '';

            items.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.model_text}</td>
                    <td>${item.model_id}</td>
                    <td>${item.quantity}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Update the hidden input with the items data
            document.getElementById('itemsInput').value = JSON.stringify(items);
        }

        // Function to remove an item from the list
        function removeItem(index) {
            items.splice(index, 1);
            updateTable();
        }
    </script>
@endsection