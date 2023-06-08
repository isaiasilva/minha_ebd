<div class="card">
    <style>
        .emoji {
            width: 28px;
            height: 28px;
            cursor: pointer;
        }

        .emoji:hover {
            width: 32px;
            height: 32px;
        }

        #meu-svg {
            filter: grayscale(100%);
        }

        #meu-svg:hover {
            filter: none;
        }
    </style>
    <div class="card-header">
        <p class="card-title text-center">Avalie esse material</p>
    </div>
    <div class="card-body ">
        <div class="d-flex justify-content-around">
            <img id="meu-svg" class="emoji" src="{{ asset('img/emojis/muito-ruim.svg') }}" alt="muito ruim">
            <img id="meu-svg" class="emoji" src="{{ asset('img/emojis/ruim.svg') }}" alt="ruim">
            <img id="meu-svg" class="emoji" src="{{ asset('img/emojis/razoavel.svg') }}" alt="razoavel">
            <img id="meu-svg" class="emoji" src="{{ asset('img/emojis/muito-bom.svg') }}" alt="muito bom">
            <img id="meu-svg" class="emoji" src="{{ asset('img/emojis/excelente.svg') }}" alt="excelente">
        </div>


    </div>
    <script>
        var svgElement = document.getElementById('meu-svg');
        svgElement.addEventListener('mouseover', function() {
            svgElement.style.filter = 'none';
        });

        svgElement.addEventListener('mouseout', function() {
            svgElement.style.filter = 'grayscale(100%)';
        });
    </script>
</div>
