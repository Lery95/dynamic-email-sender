<!DOCTYPE html>
<html>

<head>
    <title>Certificate Sender</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
        }

        input,
        button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
        }

        button {
            background: #2d6cdf;
            color: white;
            border: none;
            cursor: pointer;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Send Certificates</h2>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('certificate.upload') }}" enctype="multipart/form-data">

            @csrf

            <label>Excel File (Recipients)</label>
            <input type="file" name="excel" required>

            <label>PowerPoint Template</label>
            <input type="file" name="pptx" required>

            <button type="submit">
                Start Sending Emails
            </button>
        </form>

    </div>

</body>

</html>