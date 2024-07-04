<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>

<body>
    Hello
    <script>
        const baseUrl = "{{url('/')}}";
        const api = axios.create({
            baseURL: baseUrl
        })
    </script>
</body>

</html>