#!/bin/bash
set -e

# Remove leftover custom controllers
rm -f app/Http/Controllers/CourseController.php
rm -f app/Http/Controllers/StudentController.php
rm -f app/Http/Controllers/LecturerController.php
rm -f app/Http/Controllers/ModuleController.php
rm -f app/Http/Controllers/ExcelExportController.php
rm -f app/Http/Controllers/ExcelImportController.php

# Remove leftover models
rm -f app/Models/Course.php
rm -f app/Models/Student.php
rm -f app/Models/Lecturer.php
rm -f app/Models/Module.php

# Remove legacy views
rm -rf resources/views/courses
rm -rf resources/views/students
rm -rf resources/views/lecturers
rm -rf resources/views/modules
rm -rf resources/views/exports
rm -rf resources/views/imports

# Remove stray routes
rm -f routes/courses.php
rm -f routes/modules.php
rm -f routes/students.php
rm -f routes/lecturers.php

echo "Cleanup complete. Breeze auth and new Job Portal files remain untouched."
