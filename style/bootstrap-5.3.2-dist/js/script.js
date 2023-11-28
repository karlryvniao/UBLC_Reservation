  // Initial date
  let currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  // Function to update the calendar
  function updateCalendar() {
    const calendarBody = document.getElementById('calendar-body');
    const currentMonthElement = document.getElementById('current-month');
    currentMonthElement.textContent = new Date(currentYear, currentMonth).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

    // Clear previous month's days
    calendarBody.innerHTML = '';

    // Get the first day of the month and the last day of the month
    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);

    let currentDate = new Date(firstDay);

    // Loop through each day and append to the calendar
    while (currentDate <= lastDay) {
      const row = document.createElement('tr');

      for (let i = 0; i < 7; i++) {
        const cell = document.createElement('td');

        if (currentDate.getMonth() === currentMonth) {
          cell.textContent = currentDate.getDate();
        }

        row.appendChild(cell);
        currentDate.setDate(currentDate.getDate() + 1);
      }

      calendarBody.appendChild(row);
    }
  }

  // Function to change the month
  function changeMonth(delta) {
    currentMonth += delta;

    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    } else if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }

    updateCalendar();
  }

  // Initial calendar update
  updateCalendar();