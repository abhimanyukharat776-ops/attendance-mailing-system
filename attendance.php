<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Smart Attendance</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #0f172a;
      color: white;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background: #1e293b;
    }

    .card {
      width: 90%;
      margin: 30px auto;
      background: #1e293b;
      padding: 25px;
      border-radius: 15px;
    }

    .subjects {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .subjects button {
      padding: 8px 16px;
      border: none;
      border-radius: 20px;
      background: #334155;
      color: white;
      cursor: pointer;
    }

    .subjects button.active {
      background: #22c55e;
      color: black;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background: #334155;
      padding: 12px;
    }

    td {
      padding: 12px;
      text-align: center;
    }

    tr {
      cursor: pointer;
    }

    tr:hover {
      background: #f0f0f0;
      color: black;
    }

    .present {
      background: lightgreen !important;
      color: black;
      font-weight: bold;
    }

    .actions {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .btn {
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .email {
      background: #3b82f6;
    }

    .sms {
      background: #25d366;
    }

    .back {
      background: red;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      color: black;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="header">
    <h2>📊 Smart Attendance</h2>
  </div>

  <div class="card">

    <div class="subjects">
      <button onclick="setSubject(this,'Maths')" class="active">Maths</button>
      <button onclick="setSubject(this,'Physics')">Physics</button>
      <button onclick="setSubject(this,'Chemistry')">Chemistry</button>
      <button onclick="setSubject(this,'EME')">EME</button>
      <button onclick="setSubject(this,'UHV')">UHV</button>
      <button onclick="setSubject(this,'WDL')">WDL</button>
      <button onclick="setSubject(this,'Workshop')">Workshop</button>

    </div>

    <table id="table">
      <tr>
        <th>Roll</th>
        <th>Name</th>
      </tr>

      <tr onclick="toggle(this)">
        <td>101</td>
        <td>Abhimanyu</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>102</td>
        <td>Sandeep</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>103</td>
        <td>Pranav</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>104</td>
        <td>Afsha</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>105</td>
        <td>Pappa</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>106</td>
        <td>Bhagwat</td>
      </tr>
      <tr onclick="toggle(this)">
        <td>107</td>
        <td>Piyush</td>
      </tr>
    </table>

    <p style="text-align:center;">Present: <span id="count">0</span></p>

    <div class="actions">
      <button class="btn email" onclick="sendEmail()">📧 Email</button>
      <button class="btn sms" onclick="sendGroupWhatsApp()">👥 Group Msg</button>
      <button class="btn back" onclick="location.href='dashboard.php'">⬅ Back</button>
    </div>

  </div>

  <div class="modal" id="modal">
    <div class="modal-content">
      <h3>Message Preview</h3>
      <p id="previewText"></p>
      <button onclick="confirmSend()">Send</button>
      <button onclick="closePreview()">Cancel</button>
    </div>
  </div>

  <script>
    let selectedSubject = "Maths";

    function setSubject(btn, subject) {
      selectedSubject = subject;
      document.querySelectorAll(".subjects button").forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
    }

    const students = {
      "101": {
        name: "Abhimanyu",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "102": {
        name: "Sandeep",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "103": {
        name: "Pranav",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "104": {
        name: "Afsha",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "105": {
        name: "Pappa",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "106": {
        name: "Bhagwat",
        email: "names@gmail.com",
        mobile: "919876543210"
      },
      "107": {
        name: "Piyush",
        email: "names@gmail.com",
        mobile: "919876543210"
      }
    };


    const timetable = {
      "Monday": {
        "Maths": "01:45 PM - 02:45 PM",
        "Workshop": "03:00 PM - 05:00 PM"
      },
      "Tuesday": {
        "WDL": "10:00 AM - 12:00 PM",
        "EME": "12:45 PM - 01:45 PM",
        "Physics": "01:45 PM - 02:45 PM",
        "Workshop": "03:00 PM - 05:00 PM"
      },
      "Wednesday": {
        "Chemistry": "10:00 AM - 12:00 PM",
        "UHV": "12:45 PM - 01:45 PM",
        "EME": "01:45 PM - 02:45 PM"
      },
      "Thursday": {
        "Maths": "11:00 AM - 12:00 PM",
        "Chemistry": "12:45 PM - 01:45 PM",
        "Physics": "01:45 PM - 02:45 PM"
      },
      "Friday": {
        "UHV": "10:00 AM - 11:00 AM",
        "Chemistry": "11:00 AM - 12:00 PM",
        "Workshop": "12:45 PM - 02:45 PM",
        "Physics": "03:00 PM - 05:00 PM"
      },
      "Saturday": {
        "Maths": "10:00 AM - 11:00 AM",
        "Physics": "11:00 AM - 12:00 PM"
      }


    };

    function getToday() {
      return new Date().toLocaleDateString("en-US", {
        weekday: "long"
      });
    }

    let count = 0;
    let selected = null;


    function toggle(row) {
      if (row.classList.contains("present")) {
        row.classList.remove("present");
        count--;
      } else {
        row.classList.add("present");
        count++;
      }
      document.getElementById("count").innerText = count;
    }

    function getAbsent() {
      let arr = [];
      document.querySelectorAll("#table tr").forEach((r, i) => {
        if (i == 0) return;
        let roll = r.children[0].innerText;
        if (!r.classList.contains("present")) {
          arr.push(students[roll]);
        }
      });
      return arr;
    }

    function sendEmail() {
      let absent = getAbsent();
      absent = absent.map(s => ({
        ...s,
        subject: selectedSubject
      }));

      fetch("send_email.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(absent)
        })
        .then(res => res.text())
        .then(data => alert(data));
    }

    function getDateTime() {
      let now = new Date();
      return {
        time: now.toLocaleTimeString("en-IN")
      };
    }
function sendGroupWhatsApp(){

  let absent = getAbsent();

  if(absent.length === 0){
    alert("No absent students");
    return;
  }

  let dt = getDateTime();
  let today = getToday();

  let names = absent.map(s => s.name).join(", ");

  let lectureTime = timetable[today] && timetable[today][selectedSubject]
    ? timetable[today][selectedSubject]
    : "No Lecture Today";

  let msg = `📢 Attendance Alert

Absent Students:
${names}

Subject: ${selectedSubject}
Day: ${today}
Lecture Time: ${lectureTime}
Marked at: ${dt.time}`;

  let groupID = "YOUR_GROUP_ID_HERE";

  let url = "https://web.whatsapp.com/send?text=" + encodeURIComponent(msg) + "&chat=" + groupID;

  window.open(url, "_blank");
}
  </script>

</body>

</html>