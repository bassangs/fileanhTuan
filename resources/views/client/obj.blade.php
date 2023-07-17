<!DOCTYPE html>
<html>

<head>
    <meta charset=UTF-8 />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r126/three.min.js" integrity="sha512-n8IpKWzDnBOcBhRlHirMZOUvEq2bLRMuJGjuVqbzUJwtTsgwOgK5aS0c1JA647XWYfqvXve8k3PtZdzpipFjgg==" crossorigin="anonymous"></script>
    <script src="http://mamboleoo.be/learnThree/demos/OBJLoader.js"></script>
    <link rel="shortcut icon" href="{{ asset('client/img/logo.png') }}" type="image/png">
    <title>Xe Tốt - mô hình {{ $product->name }}</title>
    <style>
        body,
        html {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <script type="module">
        import { OrbitControls } from '{{ asset("client/js/OrbitControls.js") }}';

        let scene, camera, renderer;

        function init() {

            scene = new THREE.Scene();

            camera = new THREE.PerspectiveCamera(20, window.innerWidth / window.innerHeight, 0.1, 5000);
            camera.rotation.y = 45 / 180 * Math.PI;
            camera.position.x = 800;
            camera.position.y = 100;
            camera.position.z = 800;

            var light = new THREE.AmbientLight(0x404040);
            scene.add(light);
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
            scene.add(directionalLight);

            renderer = new THREE.WebGLRenderer({
                antialias: true
            });
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.body.appendChild(renderer.domElement);

            var controls = new OrbitControls(camera, renderer.domElement);
            controls.addEventListener('change', renderer);

            var manager = new THREE.LoadingManager();
            var loader = new THREE.OBJLoader(manager);
            loader.load(window.location.origin + '{{ $product->obj }}', function(object) {
                scene.add(object);
                animate();
            });
        }

        function animate() {
            renderer.render(scene, camera);
            requestAnimationFrame(animate);
        }
        
        init();
    </script>
</body>

</html>
