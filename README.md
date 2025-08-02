Smart Exam Scheduler and Viewer

📋 Description
The Smart Exam Scheduler and Viewer is a web-based application designed to streamline the scheduling of exams by administrators and provide students with an easy way to view their personalized exam timetables. The system ensures conflict-free exam scheduling by checking if any student has already been allotted an exam on a proposed date. Built using PHP, MySQL, and HTML, this project is suitable for academic institutions aiming to automate and validate exam timetabling processes.

The project is split into two modules:

-> Conflict-Free Exam Scheduler (Admin)

-> Personal Exam Timetable Viewer (Student)

🧰 Technology Stack

PHP – Handles backend logic, validation, and server-side processing

MySQL – Stores student data, course info, and scheduled exams

HTML/CSS – Provides frontend UI for both admin and student users

XAMPP / WAMP / LAMP – Recommended for local development and testing

🚀 How to Run This Project
📁 1. Project Structure

/exam-system/
│
├─ allot_exam.php              // Handles scheduling logic
├─ view_timetable.php          // Displays exam schedule for students
├─ index.html                  // Admin scheduling form
├─ timetable.html              // Student access page
└─ database/
   └─ stud.sql                 // Contains schema for student_master, course_master, exam_schedule
✅ 2. Setup Instructions
1. Start XAMPP/WAMP and open phpMyAdmin.

2. Create a database named stud.

3. Import the SQL script (stud.sql) to create tables:
student_master, course_master, exam_schedule

4. Place project files into htdocs (for XAMPP) or your server root.

5. Navigate to http://localhost/exam-system/index.html for admin view
or http://localhost/exam-system/timetable.html for student view.

🧪 Features
🛠️ Admin – Conflict-Free Exam Scheduler:
1. Input course code, semester, batch, and exam date

2. Checks for student-level conflicts on same date

3. Blocks scheduling if any conflict exists

4. Prevents double-booking of students across courses

📅 Student – Personal Exam Timetable Viewer:
1. Students enter registration number

2. Retrieves and displays upcoming exam schedule

3. Shows course-wise exam dates in tabular format

📌 Note
This project is modular and extensible. You can integrate features like:

1. PDF timetable export

2. Notification system

3. Exam center/room allocation

4. Department-specific access control

Images:

FIGURE-1 ER DIAGRAM OF THE EXAM ALLOTMENT AND SCHEDULE PORTEL TABLES
<img width="692" height="398" alt="image" src="https://github.com/user-attachments/assets/29426d93-30ed-4442-8da0-ffef1503ddeb" />

FIGURE-2 EXAM ALLOTMENT PAGE
<img width="692" height="402" alt="image" src="https://github.com/user-attachments/assets/18d10190-645e-4c16-acdc-a5fddf3a4cd7" />

FIGURE-3 EXAM SCHEDULE LOGIN PAGE
<img width="692" height="340" alt="image" src="https://github.com/user-attachments/assets/c66c7efe-874a-4e5a-91ba-e4389bba32ed" />

FIGURE-4 EXAM SCHEDULE PAGE
<img width="692" height="323" alt="image" src="https://github.com/user-attachments/assets/be85f408-0171-4cf7-b5dd-ac9a93a116d8" />
