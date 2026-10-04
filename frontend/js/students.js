document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("students-table-body");
    const searchInput = document.getElementById("search-student");

    if (!tableBody) return; // Only run on students.html

    let students = JSON.parse(localStorage.getItem('sps_students')) || [];

    const renderTable = (data) => {
        tableBody.innerHTML = "";
        
        if(data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; padding: 2rem; color: var(--text-muted)">No student records found.</td></tr>`;
            return;
        }

        data.forEach(student => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td style="font-weight: 500;">${student.studentNo}</td>
                <td>
                    <div style="font-weight: 500; color: var(--text-main);">${student.surname}, ${student.givenName}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">${student.email}</div>
                </td>
                <td>${student.program}</td>
                <td>${student.yearSection}</td>
                <td><span class="badge badge-${student.status.toLowerCase()}">${student.status}</span></td>
                <td>
                    <button class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;" onclick="deleteStudent('${student.id}')">Delete</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    };

    // Initial Render
    renderTable(students);

    // Frontend Search Filtering
    if (searchInput) {
        searchInput.addEventListener("input", (e) => {
            const query = e.target.value.toLowerCase();
            const filtered = students.filter(s => 
                s.surname.toLowerCase().includes(query) || 
                s.givenName.toLowerCase().includes(query) || 
                s.studentNo.toLowerCase().includes(query)
            );
            renderTable(filtered);
        });
    }

    // Global delete function for the prototype
    window.deleteStudent = (id) => {
        if (confirm("Are you sure you want to remove this record?")) {
            students = students.filter(s => s.id !== id);
            localStorage.setItem('sps_students', JSON.stringify(students));
            renderTable(students);
            showToast("Student deleted successfully.");
        }
    };
});