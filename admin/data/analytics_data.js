async function updateDashboard() {
    try {
        const response = await fetch('admin/data/getCounts.php');
        const data = await response.json();


        // making them values as numbers so addition (+) can work in total users
        const paidCount = Number(data.paid_count);
        const unpaidCount = Number(data.unpaid_count);

        // fetched data from (getCounts.php)
        document.getElementById('totalUsers').textContent = paidCount + unpaidCount;
        document.getElementById('paidCount').textContent = data.paid_count;
        document.getElementById('unpaidCount').textContent = data.unpaid_count;
        document.getElementById('maleCount').textContent = data.male_count;
        document.getElementById('femaleCount').textContent = data.female_count;
        document.getElementById('above18Count').textContent = data.above_18_count;
        document.getElementById('under18Count').textContent = data.under_18_count;
        document.getElementById('mfisCount').textContent = data.mfis_count;
        document.getElementById('notMfisCount').textContent = data.not_mfis_count;
        document.getElementById('studentInSchoolCount').textContent = data.student_in_school_count;
        document.getElementById('studentInCollegeCount').textContent = data.student_in_college_count;
        document.getElementById('parentCount').textContent = data.parent_count;
        document.getElementById('enteredEventCount').textContent = data.entered_count;
        document.getElementById('notEnteredEventCount').textContent = data.not_entered_count;
        document.getElementById('usedDinnerCount').textContent = data.used_dinner_count;
        document.getElementById('notUsedDinnerCount').textContent = data.not_used_dinner_count;


        // Return the data for chart usage
        return {
            maleCount: data.male_count,
            femaleCount: data.female_count,
            above18Count: data.above_18_count,
            under18Count: data.under_18_count,
            mfisCount: data.mfis_count,
            notMfisCount: data.not_mfis_count,
            enteredEventCount: data.entered_count,
            notEnteredEventCount: data.not_entered_count,
            usedDinnerCount: data.used_dinner_count,
            notUsedDinnerCount: data.not_used_dinner_count
        };
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}


// call the function on page load
document.addEventListener('DOMContentLoaded', updateDashboard);
