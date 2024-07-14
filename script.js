// Pre-registered users data (simulating a database)
const registeredUsers = [
    { username: 'johnDoe', email: 'john@example.com', phone: '1234567890' },
    { username: 'janeDoe', email: 'jane@example.com', phone: '0987654321' }
];

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Login form submitted!');
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const username = document.getElementById('newUsername').value;
    const password = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Check if username, email, or phone is already registered
    const isUsernameTaken = registeredUsers.some(user => user.username === username);
    const isEmailTaken = registeredUsers.some(user => user.email === email);
    const isPhoneTaken = registeredUsers.some(user => user.phone === phone);

    if (isUsernameTaken) {
        alert('Username is already taken!');
    } else if (isEmailTaken) {
        alert('Email is already registered!');
    } else if (isPhoneTaken) {
        alert('Phone number is already registered!');
    } else if (password !== confirmPassword) {
        alert('Passwords do not match!');
    } else {
        alert('Registration form submitted!');
        // Here, you would typically send the data to the server to register the new user
    }
});
