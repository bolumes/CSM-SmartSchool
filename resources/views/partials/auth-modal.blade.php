<!-- ================= MODAL LOGIN / REGISTER ================= -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- ================= LOGO ACIMA DAS TABS ================= -->
      <div class="text-center my-3">
        <img src="{{ asset('img/logo2.png') }}" 
             alt="SmartSchool Logo" 
             style="max-height:30px;">
      </div>

      <br>

      <!-- ================= TABS ================= -->
      <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#loginTab">
            <i class="bi bi-person"></i> Login
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#registerTab">
            <i class="bi bi-person-plus"></i> Register
          </a>
        </li>
      </ul>

      <div class="modal-body">

        <!-- ================= TOAST MESSAGES ================= -->
        @if(session('success'))
          <div class="toast-success">{{ session('success') }}</div>
        @endif

        @if(session('login_error'))
          <div class="toast-error">{{ session('login_error') }}</div>
        @endif

        <div class="tab-content">

          <!-- ================= LOGIN ================= -->
          <div class="tab-pane fade show active" id="loginTab">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <input type="email" class="form-control mb-3" name="email" value="{{ old('email') }}" placeholder="Entrez votre email" required>

              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" id="login_password" placeholder="Mot de passe" required>
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('login_password', this)">
                  <i class="bi bi-eye"></i>
                </button>
              </div>

              <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label">Se souvenir de moi</label>
              </div>

              <button class="btn btn-primary w-100">Connecter</button>
            </form>

            @if (Route::has('password.request'))
              <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
              </div>
            @endif
          </div>

          <!-- ================= REGISTER ================= -->
          <div class="tab-pane fade" id="registerTab">
            <form action="{{ route('register') }}" method="POST">
              @csrf

              <!-- ================= Mensagem de erro ================= -->
              @if ($errors->any())
              <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
              </div>
              @endif
              <!-- ================= Fim Mensagem de erro ================= -->

              <div class="row">

                <div class="col-md-6 mb-3">
                  <!-- Dentro do form, depois dos campos firstname e lastname -->
                  <input type="hidden" name="name" value="{{ old('firstname') }} {{ old('lastname') }}">
                  <input type="text" class="form-control" placeholder="Prénom" name="firstname" value="{{ old('firstname') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" placeholder="Nom" name="lastname" value="{{ old('lastname') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" placeholder="Téléphone" name="telephone" value="{{ old('telephone') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" placeholder="Adresse" name="address" value="{{ old('address') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                  <select class="form-control" name="function" required>
                    <option value="">Fonction...</option>
                    @if(optional(Auth::user())->function === 'Admin' || optional(Auth::user())->function === 'Direction')
                      <option value="Admin">Admin</option>
                      <option value="Direction">Direction</option>
                    @endif
                    <option value="Professeur">Professeur</option>
                    <option value="Parent">Parent</option>
                    <option value="Eleve">Eleve</option>
                  </select>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="input-group">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmermot de passe" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', this)">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>

                <div class="col-12">
                  <button class="btn btn-success w-100">S'inscrire</button>
                </div>

              </div>
            </form>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-outline-primary" data-bs-dismiss="modal">CLOSE</button>
      </div>

    </div>
  </div>
</div>

<!-- ================= TOAST STYLE ================= -->
<style>
.toast-success {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #38a169;
  color: white;
  padding: 15px 25px;
  border-radius: 8px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  z-index: 9999;
  animation: slideIn .4s, fadeOut .5s 3.5s forwards;
}

.toast-error {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #e53e3e;
  color: white;
  padding: 15px 25px;
  border-radius: 8px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  z-index: 9999;
  animation: slideIn .4s, fadeOut .5s 3.5s forwards;
}

@keyframes slideIn {
  from {opacity:0; transform:translateY(-20px);}
  to {opacity:1; transform:translateY(0);}
}

@keyframes fadeOut {
  to {opacity:0; transform:translateY(-20px);}
}
</style>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function() {

  @if(session('success') || session('login_error'))
    var modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
  @endif

  @if(session('success'))
    var tab = new bootstrap.Tab(document.querySelector('a[href="#loginTab"]'));
    tab.show();
  @endif

  @if ($errors->any())
    var modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();

    var tab = new bootstrap.Tab(document.querySelector('a[href="#registerTab"]'));
    tab.show();
  @endif

});

function togglePassword(fieldId, button) {
  let input = document.getElementById(fieldId);
  let icon = button.querySelector("i");

  if(input.type === "password") {
    input.type = "text";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  }
}

</script>