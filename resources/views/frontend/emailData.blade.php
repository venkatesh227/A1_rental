<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome!</div>
                <div class="card-body">
                    <h2>Contact Form Details:</h2>
                    <table border="1">
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Subject:</strong></td>
                            <td>{{ $subject }}</td>
                        </tr>
                        <tr>
                            <td><strong>Message:</strong></td>
                            <td>{{ $content }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
