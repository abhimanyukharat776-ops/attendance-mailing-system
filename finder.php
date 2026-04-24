<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}
?>
<h2>Finder Page</h2>
<button onclick="location.href='dashboard.php'">Back</button> <!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Finder</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: white;
        }

        .box {
            background: white;
            color: black;
            padding: 29px;
            margin: 80px auto;
            width: 450px;
            border-radius: 12px;
            box-shadow: 0 0 105px rgba(0,0,0,0.3);
        }

        input, button {
            padding: 10px;
            margin: 10px;
            width: 85%;
            border-radius: 23px;
            border:rgb(8, 8, 8) 2px solid;
        }

        button {
            background: #667eea;
            color: white;
            cursor: pointer;
        }

        #result {
            margin-top: 15px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Student Finder</h2>

    
    <input type="text" id="prn" placeholder="Enter PRN" onkeyup="if(event.key==='Enter') searchStudent()">
    <button onclick="searchStudent()">Search</button>

    <div id="result"></div>
</div>

<script>

//  STUDENT DATA 
const students = [
    {
        prn: "202556113002",
        name: "Abhimanyu.D.Kharat",
        mother: "Manisha D Kharat",
        father: "Dhammapal Kharat",
        mobile: "1236547890",
        branch: "Cyber Security"
    },

    {
    prn: "202556113003",
    name: "Rohit S Patil",
    mother: "Sunita Patil",
    father: "Suresh Patil",
    mobile: "9123456780",
    branch: "Computer Engineering"
},

{
    prn: "202556113004",
    name: "Sneha V Jadhav",
    mother: "Anita Jadhav",
    father: "Vijay Jadhav",
    mobile: "9234567811",
    branch: "Information Technology"
},

{
    prn: "202556113005",
    name: "Amit R Shinde",
    mother: "Meena Shinde",
    father: "Ramesh Shinde",
    mobile: "9345678122",
    branch: "Mechanical Engineering"
},

{
    prn: "202556113006",
    name: "Priya K Deshmukh",
    mother: "Kavita Deshmukh",
    father: "Kiran Deshmukh",
    mobile: "9456781233",
    branch: "Civil Engineering"
},

{
    prn: "202556113007",
    name: "Rahul M Pawar",
    mother: "Lata Pawar",
    father: "Mahesh Pawar",
    mobile: "9567812344",
    branch: "Electrical Engineering"
},

{
    prn: "202556113008",
    name: "Neha T Kale",
    mother: "Sarika Kale",
    father: "Tukaram Kale",
    mobile: "9678123455",
    branch: "Electronics Engineering"
},

{
    prn: "202556113009",
    name: "Akash B More",
    mother: "Jyoti More",
    father: "Baban More",
    mobile: "9781234566",
    branch: "Cyber Security"
},

{
    prn: "202556113010",
    name: "Pooja D Chavan",
    mother: "Rekha Chavan",
    father: "Dilip Chavan",
    mobile: "9892345677",
    branch: "Computer Engineering"
},

{
    prn: "202556113011",
    name: "Sagar N Gaikwad",
    mother: "Shobha Gaikwad",
    father: "Narayan Gaikwad",
    mobile: "9903456788",
    branch: "Information Technology"
},

{
    prn: "202556113012",
    name: "Komal A Wagh",
    mother: "Asha Wagh",
    father: "Anil Wagh",
    mobile: "9014567899",
    branch: "Civil Engineering"
}
    // 👉 Add more students like this
];

function searchStudent() {
    const prnInput = document.getElementById("prn").value.trim(); // 🔥 
    const resultDiv = document.getElementById("result");

    const student = students.find(s => s.prn.trim() === prnInput);

    if (student) {
        resultDiv.innerHTML = `
            <h3>Student Details</h3>
            <p><b>Name:</b> ${student.name}</p>
            <p><b>Mother Name:</b> ${student.mother}</p>
            <p><b>Father Name:</b> ${student.father}</p>
            <p><b>Mobile:</b> ${student.mobile}</p>
            <p><b>Branch:</b> ${student.branch}</p>
        `;
    } else {
        resultDiv.innerHTML = "<p style='color:red;'>No student found</p>";
    }
}

</script>

</body>
</html>