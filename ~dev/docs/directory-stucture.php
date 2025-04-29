
<?php include_once"../components/docs-header.php"; ?>
<style>
    .content {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.breadcrumb {
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #3498db;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

h1 {
    font-size: 24px;
    color: #2c3e50;
    margin-bottom: 20px;
}

.directory-structure {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
}

.directory-list {
    list-style-type: none;
    padding-left: 20px;
}

.directory-list ul {
    list-style-type: none;
    padding-left: 20px;
    margin: 5px 0;
}

.directory-list li {
    margin: 5px 0;
}

.folder {
    font-weight: bold;
    color: #2980b9;
    position: relative;
    cursor: pointer;
}

.folder::before {
    content: "📂";
    margin-right: 8px;
}

.file {
    color: #34495e;
    position: relative;
}

.file::before {
    content: "📄";
    margin-right: 8px;
}

/* Hidden class to collapse */
.hidden {
    display: none;
}

@media (max-width: 768px) {
    .directory-structure {
        font-size: 14px;
    }
}

</style>

<main class="content">
    <div class="breadcrumb">
        <a href="#">Docs</a> > <a href="#">Project Structure</a> > CoreXPHP
    </div>

    <h1>CoreXPHP Directory Structure</h1>

    <div class="directory-structure">
        <ul class="directory-list">
            <li>
                <span class="folder">CoreXPHP/</span>
                <ul>
                    <li>
                        <span class="folder">app/</span>
                        <ul>
                            <li><span class="folder">controllers/</span>
                                <ul class="hidden">
                                    <li><span class="file">HomeController.php</span></li>
                                    <li>... (other controller files)</li>
                                </ul>
                            </li>
                            <li><span class="folder">models/</span>
                                <ul class="hidden">
                                    <li><span class="file">User.php</span></li>
                                    <li>... (other model files)</li>
                                </ul>
                            </li>
                            <li><span class="folder">middlewares/</span>
                                <ul class="hidden">
                                    <li><span class="file">User.php</span></li>
                                </ul>
                            </li>
                            <li><span class="folder">views/</span>
                                <ul class="hidden">
                                    <li><span class="folder">home/</span>
                                        <ul class="hidden">
                                            <li><span class="file">index.php</span></li>
                                            <li>... (other view files)</li>
                                        </ul>
                                    </li>
                                    <li><span class="folder">@layout/</span>
                                        <ul class="hidden">
                                            <li><span class="file">layout.php</span></li>
                                            <li><span class="file">adminLayout.php</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><span class="folder">core/</span>
                                <ul>
                                    <li><span class="file">App.php</span></li>
                                    <li><span class="file">Controller.php</span></li>
                                    <li><span class="file">Database.php</span></li>
                                    <li><span class="file">Function.php</span></li>
                                    <li><span class="file">Language.php</span></li>
                                    <li><span class="file">Model.php</span></li>
                                    <li><span class="file">Paginator.php</span></li>
                                    <li><span class="file">Request.php</span></li>
                                    <li><span class="file">Response.php</span></li>
                                    <li><span class="file">Router.php</span></li>
                                    <li><span class="file">Validator.php</span></li>
                                    <li><span class="file">View.php</span></li>
                                </ul>
                            </li>
                            <li><span class="folder">helpers/</span></li>
                            <li><span class="folder">router/</span>
                                <ul class="hidden">
                                    <li><span class="file">web.php</span></li>
                                    <li><span class="file">api.php</span></li>
                                </ul>
                            </li>
                            <li><span class="file">init.php</span></li>
                            <li><span class="file">.env</span></li>
                        </ul>
                    </li>
                    <li>
                        <span class="folder">public/</span>
                        <ul class="hidden">
                            <li><span class="folder">assets/</span>
                                <ul class="hidden">
                                    <li><span class="folder">css/</span></li>
                                    <li><span class="folder">js/</span></li>
                                    <li>... (other asset files)</li>
                                </ul>
                            </li>
                            <li><span class="file">index.php</span></li>
                        </ul>
                    </li>
                    <li><span class="file">.htaccess</span></li>
                </ul>
            </li>
        </ul>
    </div>
</main>

<script>
    document.querySelectorAll('.folder').forEach(folder => {
        folder.addEventListener('click', function() {
            const siblingList = this.nextElementSibling;
            if (siblingList) {
                siblingList.classList.toggle('hidden');
            }
        });
    });
</script>
<?php include_once"../components/docs-footer.php"; ?>