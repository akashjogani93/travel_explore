<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f4f4f4;
    }

    .bus {
      display: flex;
      flex-direction: column;
    }

    .row {
      display: flex;
      margin-bottom: 10px;
    }

    .seat {
      width: 50px;
      height: 50px;
      margin: 5px;
      text-align: center;
      line-height: 50px;
      border: 2px solid #333;
      background-color: #fff;
      cursor: pointer;
      user-select: none;
    }

    .seat.occupied {
      background-color: #ccc;
      cursor: not-allowed;
    }

    .window {
      margin-right: 20px;
    }

    .middle-space {
      width: 100px; /* Adjust the width of the middle space as needed */
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const busContainer = document.querySelector('.bus');

      // Number of rows and seats per row
      const numRows = 4;
      const seatsPerRowLeft = 3;
      const seatsMiddleSpace = 1;
      const seatsPerRowRight = 1;

      // Create seats dynamically
      for (let row = 1; row <= numRows; row++) {
        const rowContainer = document.createElement('div');
        rowContainer.classList.add('row');
        busContainer.appendChild(rowContainer);

        // Left side seats
        for (let seatNum = 1; seatNum <= seatsPerRowLeft; seatNum++) {
          createSeat(rowContainer, seatNum, row);
        }

        // Middle space
        const middleSpace = document.createElement('div');
        middleSpace.classList.add('middle-space');
        rowContainer.appendChild(middleSpace);

        // Right side seats
        for (let seatNum = 1; seatNum <= seatsPerRowRight; seatNum++) {
          createSeat(rowContainer, seatNum, row);
        }
      }
    });

    function createSeat(rowContainer, seatNum, row) {
      const seat = document.createElement('div');
      seat.classList.add('seat');

      // Mark some seats as occupied (for demonstration purposes)
      if (seatNum % 3 === 0) {
        seat.classList.add('occupied');
      }

      seat.textContent = seatNum + (row - 1) * (seatsPerRowLeft + seatsMiddleSpace + seatsPerRowRight);

      // Identify window seats
      if ((row === 1 || row === numRows) && (seatNum === 1 || seatNum === seatsPerRowLeft)) {
        seat.classList.add('window');
      }

      // Add click event listener to each seat
      seat.addEventListener('click', function() {
        if (!seat.classList.contains('occupied')) {
          alert('Seat ' + seat.textContent + ' selected!');
        } else {
          alert('Seat ' + seat.textContent + ' is already occupied.');
        }
      });

      rowContainer.appendChild(seat);
    }
  </script>
  <title>Bus Seat Layout</title>
</head>
<body>
  <div class="bus"></div>
</body>
</html>
