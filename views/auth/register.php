<h1 class="mb-4">Register an Account</h1>

<form action="/register" method="post">
    <div class="form-group mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name"
               id="name" placeholder="Enter name">
    </div>
    <div class="form-group mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email"
               id="email" placeholder="Enter email">
    </div>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password"
               id="password" placeholder="Enter password">
    </div>
    <div class="form-group mb-3">
        <label for="password_confirmation" class="form-label">Password Confirmation</label>
        <input type="password" class="form-control" name="password_confirmation"
               id="password_confirmation" placeholder="Enter password confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
