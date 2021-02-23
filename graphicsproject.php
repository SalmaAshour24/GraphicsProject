<style>
	.buttons {
		position:fixed;
		top: 20px;
		left: 20px;
        	}
	button {

		width: 130px;
        height: 40px;
		font-size: 20px;
		outline: none;
		background: #333;
		color: #ddd;
		border: none;
		opacity: .5;
        margin: 5px;
        
	}
	button:hover {
		background: #222;
		color: #eee;
	}
  
</style>
<div class="buttons">
	<button onclick="solarClick()">solarsystem</button>
    <button onclick="sunClick()">Sun</button>
	<button onclick="mercuryClick()">mercury</button>
	<button onclick="venusClick()">venus</button>
	<button onclick="earthClick()">earth</button>
	<button onclick="marsClick()">mars</button>
	<button onclick="jupiterClick()">jupiter</button>
	<button onclick="saturnClick()">saturn</button>
    <button onclick="uranusClick()">uranus</button>
	<button onclick="neptuneClick()">neptune</button>
	<button onclick="moonClick()">moon</button>
</div>
<canvas id="scene"></canvas>
<script src="lib/three.min.js"></script>
<script src="lib/OrbitControls.js"></script>

<script>
	let skyboxGeo, skybox;
	let skyboxImage = 'space';
	var moon,box;
    
	moveRight = true;
	counter=0;
	var r=false;
	var ww = window.innerWidth,
	wh = window.innerHeight;
	
	function init() {
		renderer = new THREE.WebGLRenderer({canvas : document.getElementById('scene')});
		//renderer.setClearColor(0x000000);
		renderer.setSize(ww,wh);

		scene = new THREE.Scene();

		camera = new THREE.PerspectiveCamera(  100, ww/wh,0.1,15000); //!
		camera.position.set(0, -600, 600);
		
		controls = new THREE.OrbitControls(camera);

		light = new THREE.AmbientLight(0xffffff, 0.6);
		//light.position.set(0, 250, 700);
		scene.add(light);
		
	manySpheres();
    createSphere();
    animateSpheres();
	rotateSphere();
		createMaterialArray();
               	renderer.render(scene,camera);

	}
	function createMaterialArray() {
 let materialArray = [];

let texture_ft = new THREE.TextureLoader().load( 'space/space_ft.jpg');
let texture_bk = new THREE.TextureLoader().load( 'space/space_bk.jpg');
let texture_up = new THREE.TextureLoader().load( 'space/space_up.jpg');
let texture_dn = new THREE.TextureLoader().load( 'space/space_dn.jpg');
let texture_rt = new THREE.TextureLoader().load( 'space/space_rt.jpg');
let texture_lf = new THREE.TextureLoader().load( 'space/space_lf.jpg');
  
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_ft }));
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_bk }));
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_up }));
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_dn }));
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_rt }));
materialArray.push(new THREE.MeshBasicMaterial( { map: texture_lf }));
   
 	        for (let i = 0; i < 6; i++)
           materialArray[i].side = THREE.BackSide;
        let skyboxGeo = new THREE.BoxGeometry( 20000, 20000, 20000); //!
         skybox = new THREE.Mesh( skyboxGeo, materialArray );
        scene.add( skybox );  
      }
    
function remove()
	{
		scene.remove(sun);
		scene.remove(element);
		scene.remove(moonorbit);
		scene.remove(mercury);
		scene.remove(venus);
		scene.remove(earth);
		scene.remove(mars);
		scene.remove(jupiter);
		scene.remove(saturn);
		scene.remove(uranus);
		scene.remove(neptune);
		scene.remove(moon);
		scene.remove(ringm);
		scene.remove(ringv);
		scene.remove(ringe);
		scene.remove(ringma);
		scene.remove(ringj);
		scene.remove(rings);
		scene.remove(ringu);
		scene.remove(ringn);
		scene.remove(ring);
		//scene.remove(cube2);

	}
 var textArr = [];
        var textArr1 = [];

    var texts = [
        'Sun is the center of solar system',
        '4 7 . 8 7 Km/s is the speed of mercury around the sun',
        '3 5 . 0 2 Km/s is the speed of venus around the sun',        
        '2 9 . 7 8 Km/s is the speed of earth around the sun',
        '2 4 . 0 7 7 Km/s is the speed of mars around the sun',
        '1 3 . 0 7 Km/s is the speed of jupiter around the sun',
        '9 . 6 9 Km/s is the speed of saturn around the sun',
        '6 . 8 1 Km/s is the speed of uranus around the sun',
        '5 . 4 3 Km/s is the speed of neptune around the sun',
        '3 . 7 0 0 Km/h is the speed of moon around the earth',
        'soso','besbes','mahawella','shadashido',
    ]
    var fontLoader = new THREE.FontLoader();

    function createText(){
        for(let i =0; i < texts.length; i++)
        fontLoader.load("./Rogueland Free_Regular.json",function(tex){ 
        var  textGeo = new THREE.TextGeometry(texts[i], {
                size: 25,
                height: 5,
                curveSegments: 0,
                font: tex,
        });
        var  color = new THREE.Color();
        color.setRGB(255, 250, 250);
        var  textMaterial = new THREE.MeshBasicMaterial({ color: color });
        var  text = new THREE.Mesh(textGeo , textMaterial);
        text.position.set(-250,400,0);
       
            text.rotateX(1.0);
        textArr.push(text);
        })
    }
    function signature(){
        for(let i =0; i < texts.length; i++)
        fontLoader.load("./Authentic_Signature.json",function(tex){ 
        var  textGeo = new THREE.TextGeometry(texts[i], {
                size: 100,
                height: 5,
                curveSegments: 0,
                font: tex,
        });
        var  color = new THREE.Color();
        color.setRGB(255, 250, 250);
        var  textMaterial = new THREE.MeshBasicMaterial({ color: color });
        var  text1 = new THREE.Mesh(textGeo , textMaterial);
        text1.position.set(-250,400,0);
        text1.rotateX(1.0);
        textArr1.push(text1);
        })
        
    }

signature();
    createText();
	function solarClick(){
				camera.position.set(0,-600, 600);
		remove()
		createSphere();
		window.cancelAnimationFrame(requestid2);
		window.cancelAnimationFrame(requestid);
		rotateSphere();
		//switchSkyBox('space');
       // createtext();
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }

 for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }

	}
   
    function sunClick(){
      camera.position.set(0,-100, 100);
        remove();
    	createsun();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	rotateSphere();
		for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
        textArr[0].position.set(-350,400,-10)
        scene.add(textArr[0]);
        
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
        
            }

	function mercuryClick(){
		remove();
    	createmercury();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	RPlanet();
    	camera.position.set(0,-50, 50);
    	mercury.translateX(-(57910000/4501000000)*10000);
		//switchSkyBox('space');
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
        textArr[1].position.set(-480,400,-130)
        scene.add(textArr[1]);
      for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }

	}
	
	function venusClick(){
		remove();
    	createvenus();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	RPlanet();
    	camera.position.set(0,-50, 50);
    	venus.translateX(-(108200000 /4501000000)*10000);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
                textArr[2].position.set(-440,500,-70)

        scene.add(textArr[2]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	
	function earthClick(){
		remove();
    	createearth();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	RPlanet();
    	earth.position.x=(149600000  /4501000000)*10000;
    	camera.position.set(0,-50, 50);
    	earth.translateX(-(149600000  /4501000000)*10000);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
            textArr[3].position.set(-440,400,10)

        scene.add(textArr[3]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function marsClick(){
			remove();
    	createmars();
    	window.cancelAnimationFrame(requestid2);
    	RPlanet();
    	window.cancelAnimationFrame(requestid);
    	camera.position.set(0,-50, 50);
    	mars.translateX(-(227940000/4501000000)*10000);
for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
                    textArr[4].position.set(-440,300,-70)

        scene.add(textArr[4]);	
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function jupiterClick(){
		remove();
    	createjupiter();
    	window.cancelAnimationFrame(requestid2);
    	RPlanet();
    	window.cancelAnimationFrame(requestid);
    	camera.position.set(0,-100, 100);
    	jupiter.translateX(-(778330000 /4501000000)*10000);
    	//jupiter.translateY(30);
		//switchSkyBox('space');
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
            textArr[5].position.set(-440,400,-70)

        scene.add(textArr[5]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function saturnClick(){
			remove();
    	createsaturn();
    	window.cancelAnimationFrame(requestid2);
    	RPlanet();
    	window.cancelAnimationFrame(requestid);
    	camera.position.set(0,-100, 100);
    	saturn.translateX(-(1424600000/4501000000)*10000);
    	ring.translateX(-(1424600000/4501000000)*10000);
    	saturn.translateY(95);
    	ring.translateY(95);
for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
            textArr[6].position.set(-450,400,0)
        
        scene.add(textArr[6]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function uranusClick(){
		remove();
    	createuranus();
    	window.cancelAnimationFrame(requestid2);
    	RPlanet();
    	window.cancelAnimationFrame(requestid);
    	camera.position.set(0,-100, 100);
    	uranus.translateX(-(2873550000 /4501000000)*10000);
    	uranus.translateY(60);
		//switchSkyBox('space');
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
                    textArr[7].position.set(-450,400,0)

        scene.add(textArr[7]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function neptuneClick(){
			remove();
    	createneptune();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	RPlanet();
    	camera.position.set(0,-100, 100);
    	neptune.translateX(-10000);
    	neptune.translateY(100);
	    for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
                    textArr[8].position.set(-450,400,0)

        scene.add(textArr[8]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
	}
	function moonClick(){
			remove();
    	createmoon();
    	window.cancelAnimationFrame(requestid2);
    	window.cancelAnimationFrame(requestid);
    	camera.position.set(0,-20, 20);
    	moon.position.x=(149600000  /3501000000)*10000;
    	moon.translateX(-(149600000  /3501000000)*10000)
    	RPlanet();
	    for(let i =0; i<textArr.length;i++){
            scene.remove(textArr[i]);
        }
                    textArr[9].position.set(-450,500,-70)
        
           scene.add(textArr[9]);
        for(let i =0; i<textArr.length;i++){
            scene.remove(textArr1[i]);
        }
       //soso , besbes,maha,shadwdaw 
        textArr1[10].position.set(600,100,-900)
        textArr1[11].position.set(600,200,-900)
        textArr1[12].position.set(600,300,-900)
        textArr1[13].position.set(600,400,-900)
                scene.add(textArr1[10]);
                scene.add(textArr1[11]);
                scene.add(textArr1[12]);
                scene.add(textArr1[13]);
	}
	function createsun()
	{
		var texture = new THREE.TextureLoader().load("sun.jpg");
		const g1Sphere=new THREE.SphereGeometry(70,32,32);
	sm1=new THREE.MeshLambertMaterial({map: texture});
	sun=new THREE.Mesh(g1Sphere,sm1);
	scene.add(sun);
	}
	function createmercury()
	{
		//mercury
	    var texture1 = new THREE.TextureLoader().load("mercury.jpg");
	    const g2Sphere=new THREE.SphereGeometry(25,32,32);
		sm2=new THREE.MeshLambertMaterial({map: texture1});
		mercury=new THREE.Mesh(g2Sphere,sm2);
		mercury.position.x=(57910000/4501000000)*10000;
		scene.add(mercury);
	}

	function createvenus()
	{
		//venus
	var texture2 = new THREE.TextureLoader().load("venus.jpg");
    const g3Sphere=new THREE.SphereGeometry(35,32,32);
	sm3=new THREE.MeshLambertMaterial({map:texture2});
	venus=new THREE.Mesh(g3Sphere,sm3);
	venus.position.x=(108200000 /4501000000)*10000;
	scene.add(venus);
	}
	function createearth()
	{
	//earth
    var texture3 = new THREE.TextureLoader().load("earth.jpg");
    const g4Sphere=new THREE.SphereGeometry(40,32,32);
	sm4=new THREE.MeshLambertMaterial({map:texture3});
	earth=new THREE.Mesh(g4Sphere,sm4);
	//earth.rotateZ=10000;
	scene.add(earth);
	}
	function createmoon()
	{
	//moon
	var texture4 = new THREE.TextureLoader().load("moon.jpg");
    const gSphere=new THREE.SphereGeometry(40*0.25,32,32);
	sm=new THREE.MeshLambertMaterial({map:texture4});
	moon=new THREE.Mesh(gSphere,sm);
	moon.position.x=100;
	scene.add(moon);
}
function createmars()
	{
   //mars
    var texture5 = new THREE.TextureLoader().load("mars.jpg");
    const g5Sphere=new THREE.SphereGeometry(30,32,32);
	sm5=new THREE.MeshLambertMaterial({map:texture5});
	mars=new THREE.Mesh(g5Sphere,sm5);
	mars.position.x=(227940000/4501000000)*10000;
	scene.add(mars);
}
function createjupiter()
	{
    //jupiter
    var texture6 = new THREE.TextureLoader().load("jupiter.jpg");
    const g6Sphere=new THREE.SphereGeometry(60,32,32);
	sm6=new THREE.MeshLambertMaterial({map:texture6});
	jupiter=new THREE.Mesh(g6Sphere,sm6);
	jupiter.position.x=(778330000 /4501000000)*10000;
	scene.add(jupiter);
}
function createsaturn()
	{
    //saturn
    var texture7 = new THREE.TextureLoader().load("saturn.jpg");
	const g7Sphere=new THREE.SphereGeometry(55,32,32);
	sm7=new THREE.MeshLambertMaterial({map:texture7});
	saturn=new THREE.Mesh(g7Sphere,sm7);
	saturn.position.x=(1424600000/4501000000)*10000;
	scene.add(saturn);
   //saturn ring
   var texture10 = new THREE.TextureLoader().load("ringsat.jpg");
   const geometry = new THREE.RingGeometry( 100, 120, 32 );
   const material = new THREE.MeshBasicMaterial( {map:texture10} );
   ring= new THREE.Mesh( geometry, material );
   ring.position.x=(1424600000/4501000000)*10000;
   ring.position.y=0;
   scene.add(ring);
   }
    function createuranus()
	{
    //uranus
    var texture8 = new THREE.TextureLoader().load("urunas.jpg");
	const g8Sphere=new THREE.SphereGeometry(50,32,32);
	sm8=new THREE.MeshLambertMaterial({map:texture8});
	uranus=new THREE.Mesh(g8Sphere,sm8);
	uranus.position.x=(2873550000 /4501000000)*10000;
	scene.add(uranus);
}
function createneptune()
	{
    //neptune
    var texture9 = new THREE.TextureLoader().load("neptune.jpg");
    const g9Sphere=new THREE.SphereGeometry(45,32,32);
	sm9=new THREE.MeshLambertMaterial({map:texture9});
	neptune=new THREE.Mesh(g9Sphere,sm9);
	neptune.position.x=10000;
	scene.add(neptune);}

 function createSphere(){
 //	THREE.ImageUtils.crossOrigin = '';
         //grouping
    element=new THREE.Object3D();
	moonorbit=new THREE.Object3D();
	createsun();
		createmercury();
		createvenus();
		createearth();
		createmars();
		createjupiter();
		createsaturn();
		createuranus();
		createneptune();
		createmoon(); 
//mercury
   const geometrym = new THREE.RingGeometry( 137, 134, 200 );
   const materialm = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringm= new THREE.Mesh( geometrym, materialm);
   scene.add(ringm); 

//venus
	
 const geometryv = new THREE.RingGeometry( 237, 234, 500 );
   const materialv = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringv= new THREE.Mesh( geometryv, materialv);
   scene.add(ringv);

   //earth
   const geometrye = new THREE.RingGeometry( 337, 333, 500 );
   const materiale = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringe= new THREE.Mesh( geometrye, materiale);
   scene.add(ringe); 

   //mars 
   const geometryma = new THREE.RingGeometry( 507, 505, 500 );
   const materialma = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringma= new THREE.Mesh( geometryma, materialma);
   scene.add(ringma); 

//jupiter
   const geometryj = new THREE.RingGeometry( 1675, 1680, 500 );
   const materialj = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringj= new THREE.Mesh( geometryj, materialj);
   scene.add(ringj);
//saturn
  const geometrys = new THREE.RingGeometry( 3160, 3140, 1000 );
   const materials = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   rings= new THREE.Mesh( geometrys, materials);
   scene.add(rings); 
   //uranus
   const geometryu = new THREE.RingGeometry( 6300, 6260, 4000 );
   const materialu = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringu= new THREE.Mesh( geometryu, materialu);
   scene.add(ringu); 
   //neptune
   const geometryn = new THREE.RingGeometry( 9900, 9850, 5000 );
   const materialn = new THREE.MeshBasicMaterial( { color: 'white', side: THREE.DoubleSide } );
   ringn= new THREE.Mesh( geometryn, materialn);
    scene.add(ringn);
	element.add(sun);
	element.add(mercury);
	element.add(venus);
	element.add(mars);
	element.add(jupiter);
	element.add(saturn);
	element.add(uranus);
	element.add(neptune);
	element.add(ring);
	moonorbit.add(earth);
	moonorbit.add(moon);
	moonorbit.position.x=(149600000  /4501000000)*10000;
	scene.add(moonorbit);
	scene.add(element);
};
var  requestid;
var  requestid2;
var RPlanet= function()
{
	requestid2=requestAnimationFrame(RPlanet);
	mercury.rotateZ(0.01);
	venus.rotateZ(0.01);
	earth.rotateZ(0.01);
	moon.rotateZ(0.01);
	mars.rotateZ(0.01);
	jupiter.rotateZ(0.01);
	saturn.rotateZ(0.01);
	uranus.rotateZ(0.01);
	neptune.rotateZ(0.01);
	ring.rotateZ(0.01);
}
var rotateSphere = function(){
	requestid=requestAnimationFrame(rotateSphere);

	sun.rotateZ(0.01);

	mercury.translateX((57910000/4501000000)*-10000);
	mercury.rotateZ((47.87/47.87)*0.06);
	mercury.translateX((57910000/4501000000)*10000);

	venus.translateX((108200000 /4501000000)*-10000);
	venus.rotateZ((35.02/47.87)*0.06);
	venus.translateX((108200000 /4501000000)*10000);

	moonorbit.translateX((149600000  /4501000000)*-10000);
	moonorbit.rotateZ((29.78/47.87)*0.06);
	moonorbit.translateX((149600000  /4501000000)*10000);
	
	moon.translateX(-100);
	moon.rotateZ((29.78/47.87)*0.05);
	moon.translateX(100);
	
	
	mars.translateX((227940000/4501000000)*-10000);
	mars.rotateZ((24.077/47.87)*0.06);
	mars.translateX((227940000/4501000000)*10000);

	jupiter.translateX((778330000 /4501000000)*-10000);
	jupiter.rotateZ((13.07/47.87)*0.06);
	jupiter.translateX((778330000 /4501000000)*10000);

	saturn.translateX((1424600000/4501000000)*-10000);
	saturn.rotateZ((9.69/47.87)*0.06);
	saturn.translateX((1424600000/4501000000)*10000);

	uranus.translateX((2873550000 /4501000000)*-10000);
	uranus.rotateZ((6.81/47.87)*0.06);
	uranus.translateX((2873550000 /4501000000)*10000);

	neptune.translateX(-10000);
	neptune.rotateZ((5.43/47.87)*0.06);
	neptune.translateX(10000);

	ring.translateX((1424600000/4501000000)*-10000);
	ring.rotateZ((9.69/47.87)*0.06);
	ring.translateX((1424600000/4501000000)*10000);

	
		renderer.render(scene,camera);


};


function manySpheres(){

	spheres = new THREE.Object3D();

    sphereGeometry = new THREE.SphereGeometry(0.8, 5, 5);
    sphereMaterial = new THREE.MeshBasicMaterial( {color:0xFFFFFF} );

	
	for(var i=0;i<400;i++){
		sphere = new THREE.Mesh( sphereGeometry, sphereMaterial );
		
     sphere.position.x =  -1000 + Math.random() * 1800;
     sphere.position.y = -1000 + Math.random() * 1800;  
     sphere.position.z = -1000 + Math.random() * 1800;

		spheres.add(sphere);
	}
	scene.add(spheres);
};

var animateSpheres = function(){
	requestAnimationFrame(animateSpheres);
	if(moveRight){
		if(counter<120)
		{
			spheres.translateX(0.01);
			counter++;
		}
		else
			moveRight = false;
	}
	if(!moveRight)
	{
		if(counter>0){
			spheres.translateX(-0.01);
			counter--;
		}
		else
			moveRight = true;
	}


	renderer.render(scene,camera);
};
var rotation=true;
 document.addEventListener("keydown", onDocumentKeyDown, false);
 function onDocumentKeyDown(event) {
 	var keyCode = event.which;
       
    if (keyCode == 38) {
        
           camera.translateZ(-50);         
       } 
        
         else if (keyCode == 40) {

            camera.translateZ(50);
       }
       else if (keyCode == 37) {
        
           camera.translateX(-50);         
       } 
        
         else if (keyCode == 39) {

            camera.translateX(50);
       }
   }
    	
	
    

	
	init();
</script>