<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mô hình xe {{ $product->name }}</title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/three.js/r79/three.min.js"></script>
    <script src="http://mamboleoo.be/learnThree/demos/OBJLoader.js"></script>
    <style>
        body,
        html {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        canvas {
            width: 100%;
        }
    </style>
</head>

<body>
    <canvas id="scene"></canvas>
    <script>
        var scene = new THREE.Scene();
        var renderer, camera, car;

        var ww = window.innerWidth,
            wh = window.innerHeight;

        renderer = new THREE.WebGLRenderer({
            canvas: document.getElementById('scene')
        });
        renderer.setSize(ww, wh);

        camera = new THREE.PerspectiveCamera(50, ww / wh, 0.1, 10000);
        camera.position.set(0, 0, 500);
        scene.add(camera);

        //Add a light in the scene
        directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(0, 0, 350);
        directionalLight.lookAt(new THREE.Vector3(0, 0, 0));
        scene.add(directionalLight);

        var render = function() {
            requestAnimationFrame(render);
            car.rotation.y += .01;
            renderer.render(scene, camera);
        };

        var loadOBJ = function() {
            //Manager from ThreeJs to track a loader and its status
            var manager = new THREE.LoadingManager();
            //Loader for Obj from Three.js
            var loader = new THREE.OBJLoader(manager);
            //Launch loading of the obj file, addCarInScene is the callback when it's ready 
            loader.load(window.location.origin + '{{ $product->obj }}', function(object) {
                car = object;
                scene.add(car);
                render();
            });
        };

        loadOBJ();
    </script>
</body>

</html>
