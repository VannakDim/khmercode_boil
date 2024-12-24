@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Add Team</h2>
                            </div>
                            <div class="card-body">
                                <form id="dataForm" enctype="multipart/form-data">
                                    <input type="text" name="name" placeholder="Name" required>
                                    <input type="text" name="position" placeholder="Position" required>
                                    <input type="text" name="phone" placeholder="Phone" required>
                                    <input type="email" name="email" placeholder="Email" required>
                                    <input type="file" name="image" accept="image/*"> <!-- Image input -->
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.getElementById('dataForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        // Create FormData object for handling file uploads
        const formData = new FormData(this);

        try {
            // Send data to the server
            const response = await fetch('/store-data', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData // Send FormData object directly
            });

            if (response.ok) {
                const result = await response.json();
                alert(result.message); // Display success message
            } else {
                const error = await response.json();
                alert('Error: ' + error.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
</script>
@endsection
