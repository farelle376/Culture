@extends('layouts')

@section('css')
<style>
/* ===== Page container ===== */
.login-page {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f3f4f6;
    padding: 20px;
}

/* ===== Card formulaire ===== */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 30px 40px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 3px solid green;
}

/* Titre */
.page-title {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 25px;
    font-weight: 600;
    color: #333;
}

/* Formulaire */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

label {
    font-size: 0.9rem;
    margin-bottom: 5px;
    color: #333;
    font-weight: 500;
}

input {
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    font-size: 0.95rem;
    width: 100%; /* prend toute la largeur de la carte */
    box-sizing: border-box;
}

input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.18);
}

/* Button */
.btn-primary {
    width: 100%;
    background: #008751;
    color: white;
    padding: 12px;
    border-radius: 8px;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
}

.btn-primary:hover {
    background: #007040;
}

/* Responsive */
@media(max-width: 600px){
    .card {
        padding: 20px;
    }
}
</style>
@endsection

@section('content')
<div class="login-page">
    <div class="card">
        <h2 class="page-title">Se connecter</h2>

        <form method="POST" action="{{ route('inscrite') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>
             @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                        href="{{ route('password.request') }}" style="color:black; text-align:center;">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif
                <br><br>
            <button class="btn-primary mt-2">Se connecter</button>
        </form>
    </div>
</div>
@endsection
