<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SakuraLinks</title>
</head>
<body>
<div class="body">
    <header>
        <p>SakuraLinks</p>
    </header>
    <div class="firstForm">
        <form action="{{ route('url') }}" method="POST">
            @csrf
            <input class="input" type="text" name="url" placeholder="Вставьте сюда ссылку">
            <input class="button" type="submit" value="Обработать">
        </form>
    </div>
</div>

<script type="text/javascript">
    document.ondragstart = noselect;
    document.onselectstart = noselect;
    document.oncontextmenu = noselect;
    function noselect() {return false}
</script>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        font-family: "Comic Sans MS";
    }

    header {
        height: 20vh;
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
        background-image: linear-gradient(to bottom, white, palevioletred);
        font-size: 50pt;
        margin-left: 15vw;
        padding-top: 15vh;
    }

    body {
        background-image: url("images/body.jpg");
        background-repeat: no-repeat;
        background-size: 100% 120%;
    }

    .body {
        width: 50%;
        height: 100vh;
        background: rgba(38, 6, 80, 0.2);
        backdrop-filter: blur(10px);
    }

    .input, .url{
        background-color: transparent;
        color: white;
        border: 2px solid white;
        border-radius: 7px;
        outline: none;
        height: 5vh;
        font-size: 15pt;
    }

    .input {
        margin-top: 2vh;
        box-sizing: border-box; /** позволит добавить padding */
        padding: 1rem;
    }

    .url{
        display: flex;
        flex-direction: row;
        padding-top: 2vh;
        padding-left: 1vw;
    }

    .copy{
        height: 3vh;
        padding-left: 12vw;
    }

    .second {
        margin-top: 6vh;
    }

    .button {
        border: 2px solid palevioletred;
        border-radius: 7px;
        background-color: palevioletred;
        outline: none;
        height: 5vh;
        width: 12.5vw;
        margin-left: 6.25vw;
        margin-top: 10vh;
        font-size: 15pt;
        color: white;
    }

    .button:hover {
        border: 2px solid #d55b83;
        background-color: #d55b83;
        transition: background-color 0.2s linear;
    }

    form, .secondForm {
        height: 60vh;
        width: 50%;
        display: flex;
        flex-direction: column;
        margin-left: 25%;
    }

    .radio-container {
        display: flex;
        flex-direction: row;
        margin-left: 6vw;
    }

    .slider-text {
        margin-top: 5vh;
        margin-left: 1vw;
        font-size: 20pt;
        color: white;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-top: 5vh;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: palevioletred;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px palevioletred;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>

