<section class="forms-section">
  <div class="forms">
    <div class="form-wrapper is-active">
      <button type="button" class="switcher switcher-login">
        Connexion
        <span class="underline"></span>
      </button>
      <form class="form form-login" method="POST" action ="./../connexion.php"  >
        <fieldset>
          <legend>Entrez votre adresse mail ainsi que votre mot de passe pour vous connecter.</legend>
          <div class="input-block">
            <label for="login-email">E-mail</label>
            <input id="login-email" name="login-email" type="email"  required>
          </div>
          <div class="input-block">
            <label for="login-password">Mot de passe</label>
            <input id="login-password" name="login-password" type="password" required>
          </div>
        </fieldset>
        <button type="submit" class="btn-login">Se connecter</button>
      </form>
    </div>
    <div class="form-wrapper">
      <button type="button" class="switcher switcher-signup">
        Inscription
        <span class="underline"></span>
      </button>
      <form class="form form-signup" method="POST" action ="./../connexion.php">
        <fieldset>
          <legend>Entrez votre adresse mail ainsi que votre mot de passe pour vous inscrire.</legend>
          <div class="input-block">
            <label for="signup-username">Identifiant</label>
            <input id="signup-username" name="signup-username" type="text"  required>
          </div>
          <div class="input-block">
            <label for="signup-email">E-mail</label>
            <input id="signup-email" name="signup-email" type="email"  required>
          </div>
          <div class="input-block">
            <label for="signup-password">Mot de passe</label>
            <input id="signup-password" name="signup-password" type="password" required>
          </div>
          <div class="input-block">
            <label for="signup-password-confirm">Confirmation du mot de passe</label>
            <input id="signup-password-confirm" name="signup-password-confirm" type="password" required>
          </div>
        </fieldset>
        <button type="submit" class="btn-signup">Soumettre</button>
      </form>
    </div>
  </div>
</section>