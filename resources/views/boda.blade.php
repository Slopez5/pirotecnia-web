<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    {{-- https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

    <object data="{{ route('event.pdf') }}" type="application/pdf" width="100%" height="400">
        <p>It appears you don't have a PDF plugin for this browser. No biggie... you can <a href="{{ route('event.pdf') }}">click here to download the PDF file.</a></p>
    </object>
    
    {{-- https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>