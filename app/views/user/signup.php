<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Your Personal Coach</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<section class="bg-gray-50 dark:bg-gray-900">
	<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
		<a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
			<img class="h-8 mr-2" src="img/Mohamed_d.png" alt="logo">
		</a>
		<div
			class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
					Create and account
				</h1>
				<form class="space-y-4 md:space-y-6" id="signup" method="POST">
					<div>
						<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
							email</label>
						<input type="email" name="email" id="email"
							class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							placeholder="name@email.com" required="">
					</div>
					<div>
						<label for="uname"
							class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
						<input type="text" name="username" id="username"
							class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							placeholder="Enter Username" required="">
					</div>
					<div>
						<label for="password"
							class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
						<input type="password" name="password" id="password" placeholder="••••••••"
							class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							required="">
					</div>
					<div>
						<label for="confirm-password"
							class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
							password</label>
						<input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
							class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							required="">
					</div>
					<div class="flex items-start">
						<div class="flex items-center h-5">
							<input id="terms" aria-describedby="terms" type="checkbox"
								class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
								required="">
						</div>
						<div class="ml-3 text-sm">
							<label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a
									class="font-medium text-primary-600 hover:underline dark:text-primary-500"
									href="#">Terms and Conditions</a></label>
						</div>
					</div>
					<button type="submit"
						class="w-full text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create
						an account</button>
					<p class="text-sm font-light text-gray-500 dark:text-gray-400">
						Already have an account? <a href="login"
							class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
							here</a>
					</p>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var passwordField = document.getElementById('password');
		var confirmPasswordField = document.getElementById('confirm-password');

		function checkPasswordMatch(event) {
			var password = passwordField.value;
			var confirmPassword = confirmPasswordField.value;

			if (password !== confirmPassword) {
				event.preventDefault();
				alert("Passwords do not match");
			}
		}

		var form = document.getElementById('signup');

		form.addEventListener('submit', checkPasswordMatch);
	});
</script>