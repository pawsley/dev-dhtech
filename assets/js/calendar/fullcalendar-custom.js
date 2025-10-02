var calendar;
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: "prev,next today refreshButton",
      center: "title",
      right: "dayGridMonth",
    },
    customButtons: {
      refreshButton: {
        text: "",
        icon: "",
        click: function () {
          calendar.refetchEvents(); // ✅ reload data dari server
        }
      }
    },
    initialView: "dayGridMonth",
    locale: "id",       // ✅ Bahasa Indonesia
    firstDay: 1,        // ✅ Minggu dimulai dari Senin
    buttonText: {       
      today: "Hari ini",
      month: "Bulan",
    },
    navLinks: true,
    editable: false,
    selectable: false,
    nowIndicator: true,
    events: base_url + "DashboardKar/getSchedule",

    // ✅ Tambahin indikator "R" kalau hasil reschedule
    eventContent: function(arg) {
      // wrapper untuk teks event
      let wrapper = document.createElement("div");
      wrapper.classList.add("d-flex", "align-items-center");

      // span teks judul event
      let text = document.createElement("span");
      text.innerHTML = arg.event.title;

      wrapper.appendChild(text);

      // cek kalau event hasil reschedule
      if (arg.event.extendedProps.reschedule_shift != 'OFF' && arg.event.extendedProps.is_rescheduled == 1) {
        let dot = document.createElement("span");
        dot.style.display = "inline-block";
        dot.style.width = "8px";
        dot.style.height = "8px";
        dot.style.borderRadius = "50%";
        dot.style.backgroundColor = "red";
        dot.style.marginLeft = "4px"; // jarak dari teks
        dot.title = "Reschedule";     // tooltip kecil

        wrapper.appendChild(dot);
      } else if (arg.event.extendedProps.reschedule_shift == 'OFF' && arg.event.extendedProps.is_rescheduled == 1) {
        let offLabel = document.createElement("span");
        offLabel.style.display = "inline-block";
        offLabel.style.width = "8px";
        offLabel.style.height = "8px";
        offLabel.style.borderRadius = "50%";
        offLabel.style.backgroundColor = "yellow";
        offLabel.style.marginLeft = "4px"; // jarak dari teks
        offLabel.title = "Reschedule";     // tooltip kecil

        wrapper.appendChild(offLabel);
      }

      return { domNodes: [wrapper] };
    },

    // ✅ Klik event untuk buka modal
    eventClick: function(info) {
      var modal = $("#eventModal");

      modal.attr("data-schedule-id", info.event.extendedProps.id_schedule);
      modal.attr("data-user-id", info.event.extendedProps.id_user);
      modal.attr("data-work-date", info.event.startStr);

      $("#eventName").text(info.event.extendedProps.nama_lengkap);
      $("#eventShift").text(info.event.extendedProps.base_shift === 'OFF' ? 'OFF' : info.event.extendedProps.base_shift+' | '+info.event.extendedProps.base_waktu_shift);
      // Format tanggal dengan nama bulan Indonesia
      var dateObj = new Date(info.event.startStr);
      var day = dateObj.getDate();
      var month = monthNames[dateObj.getMonth()];
      var year = dateObj.getFullYear();
      var formattedDate = day + " " + month + " " + year;
      $("#eventDate").text(formattedDate);

      $("#rescheduleShift").val(null).trigger("change");
      $("#floatingTextarea").val("");

      $.get(base_url + "DashboardKar/getRescheduleByDate", { 
          id_user: info.event.extendedProps.id_user,
          work_date: info.event.startStr
        }, function(res) {
        var data = JSON.parse(res);

        if (data) {
          var option = new Option(data.shift_name, data.id_shift, true, true);
          $("#rescheduleShift").append(option).trigger("change");
          $("#floatingTextarea").val(data.note);
        } else {
          $("#rescheduleShift").val("0").trigger("change");
          $("#floatingTextarea").val("");
        }
      });

      // ✅ Disable tombol simpan kalau event hari ini
      let today = new Date();
      today.setHours(0, 0, 0, 0); // normalize to midnight

      let eventDate = new Date(info.event.start);
      eventDate.setHours(0, 0, 0, 0); // normalize to midnight

      if (eventDate <= today) {
        $('#rescheduleShift').prop('disabled', true);
        $('#floatingTextarea').prop('disabled', true);
        $("#saveEventChanges").prop("disabled", true).text("Tidak bisa reschedule!");
      } else {
        $('#rescheduleShift').prop('disabled', false);
        $('#floatingTextarea').prop('disabled', false);
        $("#saveEventChanges").prop("disabled", false).text("Simpan");
      }

      new bootstrap.Modal(document.getElementById("eventModal")).show();
    }
  });

  // render saat tab Kalender dibuka
  $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
    if ($(e.target).attr("href") === "#calender") {
      calendar.render();
      setTimeout(() => {
        let btn = document.querySelector('.fc-refreshButton-button');
        if (btn) {
          btn.innerHTML = '<i class="icofont icofont-refresh"></i>'; 
        }
      }, 10);
    }
  });
});
