import "./bootstrap";
import { debounce } from "lodash";

const checkEmail = async (email) => {
    if (email.indexOf("@") === -1) {
        return;
    }

    try {
        const token = document.getElementsByName("_token")[0];

        const response = await fetch("/api/v1/check-email", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token.value,
            },
            body: JSON.stringify({ email: email }),
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();

        if (data.exists) {
            document.getElementById("email-error").textContent =
                "The email has already been taken.";
        } else {
            document.getElementById("email-error").textContent = "";
        }
    } catch (error) {
        console.error("Error checking email:", error);
        return false;
    }
};

const debouncedCheckEmail = debounce(checkEmail, 500);

window.addEventListener("DOMContentLoaded", () => {
    document.querySelector("input#email")?.addEventListener("keyup", (e) => {
        debouncedCheckEmail(e.target.value);
    });
});

const checkUserName = async (username) => {
    if (username.length < 3) {
        return;
    }

    try {
        const token = document.getElementsByName("_token")[0];

        const response = await fetch("/api/v1/check-username", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token.value,
            },
            body: JSON.stringify({ username: username }),
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();

        if (data.exists) {
            document.getElementById("name-error").textContent =
                "The username has already been taken.";
        } else {
            document.getElementById("name-error").textContent = "";
        }
    } catch (error) {
        console.error("Error checking username:", error);
        return false;
    }
};

const debouncedcheckUserName = debounce(checkUserName, 500);

window.addEventListener("DOMContentLoaded", () => {
    document.querySelector("input#name")?.addEventListener("keyup", (e) => {
        debouncedcheckUserName(e.target.value);
    });
});
