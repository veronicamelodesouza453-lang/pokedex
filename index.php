<!-- index.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex Ultimate</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background:
                radial-gradient(circle at top left, #1e1e2f, #090909);
            min-height: 100vh;
            overflow-x: hidden;
            color: white;
            position: relative;
        }

        canvas {
            position: fixed;
            inset: 0;
            z-index: -1;
        }

        .titulo {
            text-align: center;
            padding: 40px 0 20px;
        }

        .titulo h1 {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(90deg, #ffcc00, #ff00aa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-box {
            max-width: 500px;
            margin: auto;
            margin-bottom: 40px;
        }

        .form-control {
            border-radius: 20px;
            padding: 14px;
            border: 2px solid #ff00aa;
            background: rgba(255,255,255,0.08);
            color: white;
            backdrop-filter: blur(10px);
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .pokemon-item {
            display: flex;
        }

        /* CARD */

        .pokemon-card {
            position: relative;
            width: 100%;
            min-height: 430px;

            border-radius: 28px;

            overflow: hidden;

            background:
                linear-gradient(145deg,
                    rgba(255,255,255,0.15),
                    rgba(255,255,255,0.03));

            backdrop-filter: blur(14px);

            border: 1px solid rgba(255,255,255,0.2);

            transition: 0.2s ease;

            transform-style: preserve-3d;

            cursor: pointer;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.5);

            display: flex;
            flex-direction: column;
        }

        /* HOLOGRÁFICO */

        .pokemon-card::before {
            content: '';
            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    125deg,
                    transparent 10%,
                    rgba(255,255,255,0.15) 30%,
                    rgba(255,0,200,0.2) 45%,
                    rgba(0,255,255,0.2) 60%,
                    transparent 80%
                );

            background-size: 300% 300%;

            animation: holografico 8s linear infinite;

            mix-blend-mode: screen;

            opacity: 0.8;

            pointer-events: none;
        }

        @keyframes holografico {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        .pokemon-card:hover {
            box-shadow:
                0 25px 45px rgba(0,0,0,0.6),
                0 0 25px rgba(255,0,200,0.4);
        }

        .shine {
            position: absolute;
            inset: 0;
            pointer-events: none;
            border-radius: 28px;
        }

        .pokemon-img {
            height: 220px;

            display: flex;
            justify-content: center;
            align-items: center;

            position: relative;
        }

        .pokemon-img img {
            width: 150px;
            z-index: 2;

            filter:
                drop-shadow(0 15px 25px rgba(0,0,0,0.4));

            animation: flutuar 3s ease-in-out infinite;
        }

        @keyframes flutuar {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .pokemon-info {
            padding: 20px;
            flex: 1;
            z-index: 2;
        }

        .pokemon-info h3 {
            font-weight: 800;
            margin-bottom: 15px;
        }

        /* RARIDADE */

        .raridade {
            position: absolute;
            top: 15px;
            right: 15px;

            background: gold;
            color: black;

            padding: 5px 12px;
            border-radius: 20px;

            font-size: 0.75rem;
            font-weight: bold;

            z-index: 3;
        }

        /* SHINY */

        .shiny {
            position: absolute;
            top: 15px;
            left: 15px;

            font-size: 1.4rem;

            animation: brilho 1.5s infinite;
        }

        @keyframes brilho {
            0%,100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.3); }
        }

        .tipo {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 20px;
            margin: 3px;
            font-size: 0.8rem;
            font-weight: 700;
            color: white;
        }

        /* MODAL */

        .modal-content {
            background: transparent;
            border: none;
        }

        .pokemon-modal-card {
            position: relative;

            background:
                linear-gradient(145deg,
                    rgba(255,255,255,0.12),
                    rgba(255,255,255,0.04));

            backdrop-filter: blur(20px);

            border-radius: 30px;

            overflow: hidden;

            padding: 30px;

            color: white;

            border: 1px solid rgba(255,255,255,0.2);

            animation: abrirCarta .8s ease;
        }

        @keyframes abrirCarta {
            0% {
                transform:
                    rotateY(90deg)
                    scale(.5);

                opacity: 0;
            }

            100% {
                transform:
                    rotateY(0deg)
                    scale(1);

                opacity: 1;
            }
        }

        /* POKEBOLA */

        .pokebola {
            position: absolute;
            width: 120px;
            height: 120px;

            border-radius: 50%;

            background:
                linear-gradient(
                    to bottom,
                    #ff1e1e 50%,
                    white 50%
                );

            top: 50%;
            left: 50%;

            transform:
                translate(-50%, -50%);

            z-index: 10;

            animation: abrirPokebola 1s forwards;
        }

        .pokebola::before {
            content: '';
            position: absolute;
            width: 120px;
            height: 10px;
            background: black;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .pokebola::after {
            content: '';
            position: absolute;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            border: 8px solid black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes abrirPokebola {
            0% {
                transform:
                    translate(-50%, -50%)
                    scale(1);

                opacity: 1;
            }

            100% {
                transform:
                    translate(-50%, -50%)
                    scale(3);

                opacity: 0;
            }
        }

        .modal-pokemon-img {
            width: 220px;
            display: block;
            margin: auto;

            animation: flutuar 3s infinite ease-in-out;
        }

        .modal-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-top: 15px;
        }

        .stats {
            margin-top: 25px;
        }

        /* BARRAS */

        .barra {
            background: rgba(255,255,255,0.1);
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .barra span {
            display: block;
            height: 20px;
            border-radius: 30px;
            background:
                linear-gradient(90deg,
                    #00ff88,
                    #00b4ff);

            animation: carregar 1.5s ease;
        }

        @keyframes carregar {
            from {
                width: 0;
            }
        }

        .btn-close-custom {
            position: absolute;
            top: 15px;
            right: 15px;

            width: 40px;
            height: 40px;

            border: none;
            border-radius: 50%;

            background: white;

            font-weight: bold;

            z-index: 20;
        }

        footer {
            text-align: center;
            padding: 40px;
            color: rgba(255,255,255,0.7);
        }

        /* TIPOS */

        .Grass { background: #43aa5c; }
        .Poison { background: #9d4edd; }
        .Fire { background: #F15A29; }
        .Water { background: #3a86ff; }
        .Bug { background: #7cb518; }
        .Flying { background: #4895ef; }
        .Normal { background: #adb5bd; }
        .Electric { background: #ffd60a; color: #7A184A; }
        .Ground { background: #9c6644; }
        .Psychic { background: #ff4fd8; }
        .Rock { background: #6c757d; }
        .Fighting { background: #c1121f; }
        .Ice { background: #90e0ef; color: #333; }
        .Fairy { background: #ff99c8; color: #7A184A; }

    </style>
</head>

<body>

<canvas id="particles"></canvas>

<?php
$json = file_get_contents("pokemon.json");
$dados = json_decode($json, true);

$raridades = ["Common", "Rare", "Epic", "Legendary"];
?>

<div class="container">

    <div class="titulo">
        <h1>Pokemons - Lista Completa</h1>
        <p>Confira as Cartinhas de Pokémon</p>
    </div>

    <div class="search-box">
        <input type="text" class="form-control" id="pesquisa" placeholder="Pesquisar Pokémon...">
    </div>

    <div class="row g-4">

        <?php foreach ($dados['pokemon'] as $pokemon):

            $raridade = $raridades[array_rand($raridades)];
            $shiny = rand(0, 4) == 1;

        ?>

            <div class="col-md-4 col-lg-3 pokemon-item">

                <div class="pokemon-card"
                    data-bs-toggle="modal"
                    data-bs-target="#pokemonModal"

                    data-name="<?= $pokemon['name'] ?>"
                    data-num="<?= $pokemon['num'] ?>"
                    data-img="<?= $pokemon['img'] ?>"
                    data-height="<?= $pokemon['height'] ?>"
                    data-weight="<?= $pokemon['weight'] ?>"
                    data-spawn="<?= $pokemon['spawn_time'] ?>"
                    data-type="<?= implode(', ', $pokemon['type']) ?>"
                    data-weaknesses="<?= implode(', ', $pokemon['weaknesses']) ?>">

                    <div class="shine"></div>

                    <div class="raridade">
                        <?= $raridade ?>
                    </div>

                    <?php if($shiny): ?>
                        <div class="shiny">✨</div>
                    <?php endif; ?>

                    <div class="pokemon-img">
                        <img src="<?= $pokemon['img'] ?>">
                    </div>

                    <div class="pokemon-info">

                        <h3>
                            #<?= $pokemon['num'] ?>
                            <?= $pokemon['name'] ?>
                        </h3>

                        <?php foreach ($pokemon['type'] as $tipo): ?>
                            <span class="tipo <?= $tipo ?>">
                                <?= $tipo ?>
                            </span>
                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<!-- MODAL -->

<div class="modal fade" id="pokemonModal">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="pokemon-modal-card">

                <div class="pokebola"></div>

                <button class="btn-close-custom" data-bs-dismiss="modal">
                    ✕
                </button>

                <img id="modalImg" class="modal-pokemon-img">

                <h2 class="modal-title" id="modalName"></h2>

                <div class="text-center mt-3" id="modalTypes"></div>

                <div class="stats">

                    <p><strong>Altura:</strong> <span id="modalHeight"></span></p>
                    <p><strong>Peso:</strong> <span id="modalWeight"></span></p>
                    <p><strong>Spawn:</strong> <span id="modalSpawn"></span></p>

                    <hr>

                    <h5>Stats</h5>

                    <p>HP</p>
                    <div class="barra">
                        <span style="width: 90%"></span>
                    </div>

                    <p>Attack</p>
                    <div class="barra">
                        <span style="width: 75%"></span>
                    </div>

                    <p>Defense</p>
                    <div class="barra">
                        <span style="width: 60%"></span>
                    </div>

                    <hr>

                    <h5>Evolução</h5>

                    <p id="evolucao">
                        Este Pokémon possui evoluções misteriosas...
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<footer>
    Pokédex criada com PHP + JSON
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // PESQUISA

    const pesquisa = document.getElementById('pesquisa');

    pesquisa.addEventListener('keyup', () => {

        let valor = pesquisa.value.toLowerCase();

        document.querySelectorAll('.pokemon-item').forEach(item => {

            item.style.display =
                item.innerText.toLowerCase().includes(valor)
                ? 'block'
                : 'none';

        });

    });

    // SOM

    const som = new Audio(
        'https://raw.githubusercontent.com/PokeAPI/cries/main/cries/pokemon/latest/25.ogg'
    );

    // MODAL

    const modal = document.getElementById('pokemonModal');

    modal.addEventListener('show.bs.modal', function(event) {

        const card = event.relatedTarget;

        document.getElementById('modalName').innerText =
            card.dataset.name;

        document.getElementById('modalImg').src =
            card.dataset.img;

        document.getElementById('modalHeight').innerText =
            card.dataset.height;

        document.getElementById('modalWeight').innerText =
            card.dataset.weight;

        document.getElementById('modalSpawn').innerText =
            card.dataset.spawn;

        // TIPOS

        let tipos = '';

        card.dataset.type.split(', ').forEach(tipo => {

            tipos += `
                <span class="tipo ${tipo}">
                    ${tipo}
                </span>
            `;

        });

        document.getElementById('modalTypes').innerHTML = tipos;

        // SOM

        som.currentTime = 0;
        som.play();

        // POKEBOLA RESET

        const old = document.querySelector('.pokebola');

        if(old) old.remove();

        const pokebola = document.createElement('div');

        pokebola.classList.add('pokebola');

        document.querySelector('.pokemon-modal-card')
            .prepend(pokebola);

    });

    // TILT 3D

    document.querySelectorAll('.pokemon-card').forEach(card => {

        card.addEventListener('mousemove', e => {

            const rect = card.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / 18);
            const rotateY = ((centerX - x) / 18);

            card.style.transform =
                `
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                scale(1.05)
                `;

            // BRILHO

            const shine = card.querySelector('.shine');

            shine.style.background =
                `
                radial-gradient(
                    circle at ${x}px ${y}px,
                    rgba(255,255,255,0.4),
                    transparent 40%
                )
                `;

        });

        card.addEventListener('mouseleave', () => {

            card.style.transform =
                `
                rotateX(0deg)
                rotateY(0deg)
                scale(1)
                `;

        });

    });

    // PARTÍCULAS

    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let particles = [];

    for(let i = 0; i < 80; i++) {

        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            radius: Math.random() * 3,
            speed: Math.random() * 1
        });

    }

    function animate() {

        ctx.clearRect(0,0,canvas.width,canvas.height);

        particles.forEach(p => {

            p.y += p.speed;

            if(p.y > canvas.height)
                p.y = 0;

            ctx.beginPath();

            ctx.arc(p.x, p.y, p.radius, 0, Math.PI*2);

            ctx.fillStyle =
                'rgba(255,255,255,0.4)';

            ctx.fill();

        });

        requestAnimationFrame(animate);

    }

    animate();

</script>

</body>

</html>