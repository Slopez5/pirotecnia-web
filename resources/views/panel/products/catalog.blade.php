<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
    <style>
        gmp-map {
            height: 500px;
        }
    </style>
</head>

<body>
    <section>
        <div class="row">
            <iframe src="{{ asset('pdf/Catalogo_Pirotecnia_2025.pdf') }}" height="500px"></iframe>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <gmp-map center="19.3260238,-103.5886098" zoom="15" map-id="DEMO_MAP_ID">
                    <gmp-advanced-marker position="19.3242864,-103.590059" title="My location"></gmp-advanced-marker>
                </gmp-map>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Abejorro" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="2" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Abejorrin" :price="50" :oldPrice="100" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="3" mage="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Abejorro Bomber" :price="100" :oldPrice="200" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="3" mage="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Asteroide" :price="100" :oldPrice="200" :discount="50" :rating="4.5" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Bailarina C/Cracker" :price="49" :oldPrice="98" :discount="50"
                    :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Bob esponja" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Camelia" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Cañon bebe" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Cañon estallin" :price="49" :oldPrice="98" :discount="50"
                    :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Cañon mediano" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Cañon R-15" :price="49" :oldPrice="98" :discount="50" :rating="4.5" />
            </div>
            <div class="col">
                <x-product-card id="1" image="{{ asset('images/bag.png') }}" category="Life Style"
                    title="Carrillera 80/16" :price="49" :oldPrice="98" :discount="50"
                    :rating="4.5" />
            </div>
        </div> --}}
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKXdGsDoTIBlBJ7nXC0t-xuKqxobJiGDk&callback=console.debug&libraries=maps,marker&v=beta">
    </script>
</body>

</html>
