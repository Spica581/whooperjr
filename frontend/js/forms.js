document.addEventListener("DOMContentLoaded", () => {
    const studentForm = document.getElementById("add-student-form");
    
    // Populate Select Dropdowns
    const lookups = JSON.parse(localStorage.getItem('sps_lookups'));
    if (lookups) {
        const populateSelect = (id, data) => {
            const el = document.getElementById(id);
            if(el) data.forEach(item => el.add(new Option(item, item)));
        };
        populateSelect("campus", lookups.campuses);
        populateSelect("program", lookups.programs);
        populateSelect("yearSection", lookups.yearSections);
        populateSelect("sex", lookups.sexes);
        populateSelect("status", lookups.statuses);
    }

    // Handle Form Submit
    if (studentForm) {
        studentForm.addEventListener("submit", (e) => {
            e.preventDefault();
            
            // Gather form data
            const formData = new FormData(studentForm);
            const newStudent = Object.fromEntries(formData.entries());
            
            // Add unique ID
            newStudent.id = Date.now().toString();

            // Save to LocalStorage
            const students = JSON.parse(localStorage.getItem('sps_students')) || [];
            students.unshift(newStudent); // Add to beginning
            localStorage.setItem('sps_students', JSON.stringify(students));

            showToast("Student profile created successfully!");
            
            // Redirect to list page after 1 second
            setTimeout(() => {
                window.location.href = "students.html";
            }, 1000);
        });
    }
});