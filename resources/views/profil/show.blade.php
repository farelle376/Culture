@extends('layouts.app')

@section('content')
@section('css')
<style>
    .profile-container {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
}

.profile-avatar {
    width: 90px;
    height: 90px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    font-size: 2.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 10px;
}

.profile-name {
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 10px;
}

.profile-email {
    color: #666;
}

.profile-section h3 {
    margin-bottom: 20px;
    color: var(--dark-color);
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-group input:focus {
    border-color: var(--primary-color);
    outline: none;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
    padding: 12px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    width: 100%;
    margin-top: 15px;
}

.btn-primary:hover {
    background: #006b41;
}

</style>
@endsection
<div class="profile-container">

    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
        </div>

        <h2 class="profile-name">{{ Auth::user()->nom }}</h2>
        <p class="profile-email">{{ Auth::user()->email }}</p>
    </div>

    <div class="profile-section">
        <h3>Informations personnelles</h3>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" value="{{ Auth::user()->nom }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}">
            </div>

            <div class="form-group">
                <label>Changer le mot de passe</label>
                <input type="password" name="password" placeholder="Nouveau mot de passe">
            </div>

            <button type="submit" class="btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

</div>
@endsection
