<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="/fyp/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="Icon">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">Logout</button>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <h1>Upcoming Appointments</h1>
        <table class="appointment-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="appointmentBody">
                <!-- Appointments will be dynamically loaded here -->
            </tbody>
        </table>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Example appointments, fetched from server ideally
            const appointments = [
                { id: 1, date: '2024-10-05', time: '8:00 AM', doctor: 'Dr. Smith', status: 'waiting' },
                { id: 2, date: '2024-10-10', time: '10:00 AM', doctor: 'Dr. Johnson', status: 'waiting' }
            ];

            const appointmentBody = document.getElementById('appointmentBody');

            appointments.forEach(appointment => {
                const row = document.createElement('tr');

                const dateCell = document.createElement('td');
                dateCell.textContent = appointment.date;
                row.appendChild(dateCell);

                const timeCell = document.createElement('td');
                timeCell.textContent = appointment.time;
                row.appendChild(timeCell);

                const doctorCell = document.createElement('td');
                doctorCell.textContent = appointment.doctor;
                row.appendChild(doctorCell);

                const statusCell = document.createElement('td');
                const statusButton = document.createElement('button');
                statusButton.textContent = appointment.status === 'waiting' ? 'Waiting' : 'Join';
                statusButton.classList.add('status-button');
                
                if (appointment.status === 'waiting') {
                    statusButton.disabled = true; // Disabled until doctor starts the call
                } else {
                    statusButton.onclick = function() {
                        window.location.href = '/fyp/patient/onlinecon.php'; // Redirect to join consultation
                    };
                }

                statusCell.appendChild(statusButton);
                row.appendChild(statusCell);

                appointmentBody.appendChild(row);
            });

            // Simulate doctor starting the call after a few seconds (for demo purposes)
            setTimeout(() => {
                // In a real system, this should be driven by the backend when the doctor initiates the call
                const statusButtons = document.querySelectorAll('.status-button');
                statusButtons.forEach(button => {
                    button.textContent = 'Join';
                    button.disabled = false;
                    button.onclick = function() {
                        window.location.href = '/fyp/patient/onlinecon.php'; // Redirect to the video consultation
                    };
                });
            }, 5000); // Simulate the doctor starting the call after 5 seconds
        });
    </script>
</body>
</html>
