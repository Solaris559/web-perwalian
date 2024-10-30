document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form dari submit default

    // Ambil data dari form
    const id = document.getElementById("id").value;
    const password = document.getElementById("password").value;

    // Lakukan fetch ke API
    fetch("https://apiteam.v-project.my.id/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                id,
                password
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                localStorage.setItem('token', data.data.token);
                localStorage.setItem('id', data.data.id);
                // Cek role pengguna
                switch (data.data.role) {
                    case "staff":
                        window.location.href = "../user-adm/upload_khs.html"; // Ganti dengan URL dashboard admin
                        break;
                    case "dosen":
                        window.location.href = "../user-d/data_mahasiswa.html"; // Ganti dengan URL dashboard dosen
                        break;
                    case "mahasiswa":
                        window.location.href = "../user-m/beranda.html"; // Ganti dengan URL dashboard mahasiswa
                        break;
                    default:
                        alert("Role tidak dikenali");
                        localStorage.setItem('token', '');
                }
            } else {
                alert(data.data.message); // Tampilkan pesan error jika login gagal
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert(
                "Terjadi kesalahan saat melakukan login. Silakan coba lagi."
            );
        });
});
