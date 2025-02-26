<!DOCTYPE html>
<html>
    <body>
        <div class="container">
            <div class="content">
                This is content
            </div>
            <button class="toggle-content" onclick="toggleVisibility()">
                Toggle Content
            </button>
        </div>
        <script>
            const toggleVisibility = () => {
                
                const element = document.querySelector(".content");
                
                if (element.style.display === "none") {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            }
        </script>
    </body>
</html>