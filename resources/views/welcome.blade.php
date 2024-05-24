<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Kısaltma Servisi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center">URL Kısaltma Servisi</h1>
                <form id="urlForm" action="{{ route('shorten.url') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="url">Uzun URL:</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com" required>
                        <div class="invalid-feedback">Lütfen geçerli bir URL giriniz.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Kısalt</button>
                </form>
                @if (session('shortenedUrl'))
                    <div class="alert alert-success mt-4">
                        <strong>Kısaltılmış URL:</strong> <a href="{{ session('shortenedUrl') }}" target="_blank">{{ session('shortenedUrl') }}</a>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.getElementById('urlForm').addEventListener('submit', function(event) {
            var urlInput = document.getElementById('url');
            if (urlInput.value.trim() === '') {
                event.preventDefault();
                urlInput.classList.add('is-invalid');
            } else {
                urlInput.classList.remove('is-invalid');
            }
        });
    </script>
</body>
</html>
