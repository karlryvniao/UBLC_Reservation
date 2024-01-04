$(document).ready(function() {
    // Fetch trip tickets from the server
    $.ajax({
        type: "GET",
        url: "dashboard.php",
        dataType: "json",
        success: function(data) {
            displayTripTickets(data);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching trip tickets:", error);
        }
    });

    function displayTripTickets(tickets) {
        var tripTicketList = $("#tripTicketList");

        if (tickets.length > 0) {
            var html = "<ul class='list-group'>";
            tickets.forEach(function(ticket) {
                var statusClass = getStatusClass(ticket.status);
                html += "<li class='list-group-item " + statusClass + "'>" + ticket.ticket_id + " - " + getStatusText(ticket.status) + "</li>";
            });
            html += "</ul>";

            tripTicketList.html(html);
        } else {
            tripTicketList.html("<p>No trip tickets found.</p>");
        }
    }

    function getStatusText(status) {
        switch (status) {
            case 'pending':
                return 'Pending';
            case 'approved':
                return 'Approved';
            case 'cancelled':
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    function getStatusClass(status) {
        switch (status) {
            case 'pending':
                return 'list-group-item-warning';
            case 'approved':
                return 'list-group-item-success';
            case 'cancelled':
                return 'list-group-item-danger';
            default:
                return '';
        }
    }
});
