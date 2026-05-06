<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="left">
        <img class="imagem" src="/img/Imagem1.png" alt="Imagem Logo Instituto">
        <h2 class="subtitle">Acesso ao Sistema</h2>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first('email') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email"
                           placeholder="seu@email.com" value="{{ old('email') }}" required>
                </div>
                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </div>

    <div class="side-image">
        <img src="/img/Humaniza.png" alt="Imagem de fundo">
    </div>
</body>
</html>