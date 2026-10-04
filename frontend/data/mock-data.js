// Default mock data based on requirements
const initialStudents = [
    {
        id: "1",
        studentNo: "2026-0001",
        surname: "Valencia",
        givenName: "Sean",
        middleName: "",
        email: "sean.valencia@email.com",
        campus: "Main Campus",
        program: "BS Information Technology",
        yearSection: "Year 3",
        status: "Active",
        sex: "Male"
    },
    {
        id: "2",
        studentNo: "2026-0002",
        surname: "Ballesteros",
        givenName: "Sebastian",
        middleName: "",
        email: "sebastian.ballesteros@email.com",
        campus: "Main Campus",
        program: "BS Information Technology",
        yearSection: "Year 3",
        status: "Active",
        sex: "Male"
    },
    {
        id: "3",
        studentNo: "2025-0142",
        surname: "Frias",
        givenName: "Nicole",
        middleName: "",
        email: "nicole.frias@email.com",
        campus: "Main Campus",
        program: "BS Information Technology",
        yearSection: "Year 3",
        status: "Active",
        sex: "Female"
    },
    {
        id: "4",
        studentNo: "2024-0088",
        surname: "Santiago",
        givenName: "Lucas",
        middleName: "",
        email: "lucas.santiago@email.com",
        campus: "Main Campus",
        program: "BS Information Technology",
        yearSection: "Year 3-2",
        status: "Active",
        sex: "Male"
    },
    {
        id: "5",
        studentNo: "2024-0089",
        surname: "Albano",
        givenName: "Aaron",
        middleName: "",
        email: "aaron.albano@email.com",
        campus: "Main Campus",
        program: "BS Information Technology",
        yearSection: "Year 3-2",
        status: "Active",
        sex: "Male"
    }
];

const mockLookups = {
    campuses: ["Main Campus", "North Campus"],
    programs: ["BS Information Technology", "BS Aviation Maintenance", "BS Aeronautical Engineering"],
    yearSections: ["Year 1", "Year 2", "Year 3", "Year 3-2", "Year 4"],
    sexes: ["Male", "Female"],
    statuses: ["Active", "Inactive", "Irregular"]
};

// Initialize localStorage so data persists across page navigation in the prototype
if (!localStorage.getItem('sps_students')) {
    localStorage.setItem('sps_students', JSON.stringify(initialStudents));
}
if (!localStorage.getItem('sps_lookups')) {
    localStorage.setItem('sps_lookups', JSON.stringify(mockLookups));
}