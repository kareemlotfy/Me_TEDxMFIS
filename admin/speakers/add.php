<?php
session_start();
require_once("../../Misc/db_conn.php");
// require_once("../../Misc/functions.php");
// adminLogin();
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Speaker</title>
    <link rel="icon" type="image/x-icon" href="../../admin/assets/img/logos/x-art.png" />
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />
    
    <style>
        .form-card {
            background: #fff;
            border-radius: .375rem;
            box-shadow: 0 2px 6px 0 rgba(34, 48, 62, .08);
        }
        .card-header-custom {
            padding: 1.5rem;
            border-bottom: 1px solid #e4e6e8;
        }
        .card-header-custom h5 {
            margin: 0;
            color: #384551;
            font-weight: 600;
        }
        .card-body-custom {
            padding: 2rem;
        }
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e4e6e8;
        }
        .form-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #384551;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .section-title i {
            color: #e62b1e;
            font-size: 1.25rem;
        }
        .word-counter {
            margin-top: .5rem;
            font-size: .875rem;
            font-weight: 500;
            color: #8592a3;
        }
        .word-counter.warning {
            color: #ffab00;
        }
        .word-counter.error {
            color: #ff3e1d;
        }
        .image-upload-area {
            border: 2px dashed #e4e6e8;
            border-radius: .375rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all .3s;
        }
        .image-upload-area:hover {
            border-color: #e62b1e;
            background: #fafafa;
        }
        .image-upload-area.has-file {
            border-style: solid;
            border-color: #71dd37;
        }
        .image-preview {
            margin-top: 1rem;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 300px;
            border-radius: .375rem;
            box-shadow: 0 2px 6px 0 rgba(34, 48, 62, .12);
        }
        .input-group-btn {
            display: flex;
            gap: .5rem;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .alert {
            border: none;
            border-left: 3px solid;
        }
    </style>
</head>
<body>
    <!-- Add your nav/aside here -->
    
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="page-header">
                <div>
                    <h4 class="mb-1">Add New Speaker</h4>
                    <p class="text-muted mb-0">Create a new speaker profile</p>
                </div>
                <a href="admin/speakers/manage.php" class="btn btn-label-secondary">
                    <i class='bx bx-arrow-back me-1'></i> Back to List
                </a>
            </div>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible mb-4">
                    <strong>Error!</strong> <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                </div>
            <?php endif; ?>
            
            <form action="admin/speakers/process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-card">
                            <div class="card-header-custom">
                                <h5>Speaker Information</h5>
                            </div>
                            <div class="card-body-custom">
                                
                                <!-- Basic Info Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class='bx bx-user'></i>
                                        <span>Basic Information</span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="full_name" required maxlength="100" placeholder="e.g., Dr. Sarah Ahmed">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Job Title / Role <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="job_title" required maxlength="150" placeholder="e.g., Environmental Scientist & Climate Innovator">
                                    </div>
                                    
                                    <div>
                                        <label class="form-label">Biography <span class="text-danger">*</span> <small class="text-muted">(Max 50 words)</small></label>
                                        <textarea class="form-control" name="bio_raw" id="bioField" rows="5" required placeholder="Enter speaker biography..."></textarea>
                                        <div class="word-counter" id="wordCounter">0 / 50 words</div>
                                    </div>
                                </div>
                                
                                <!-- Photo Upload Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class='bx bx-image'></i>
                                        <span>Speaker Photo</span>
                                    </div>
                                    
                                    <input type="file" id="imageInput" name="speaker_image" accept="image/jpeg,image/png,image/jpg,image/webp" required hidden>
                                    <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                                        <i class='bx bx-cloud-upload' style="font-size: 3rem; color: #8592a3;"></i>
                                        <h6 class="mt-2">Click to upload image</h6>
                                        <p class="text-muted mb-0">JPEG, PNG, WebP • Max 5MB • Original dimensions preserved</p>
                                    </div>
                                    <div class="image-preview" id="imagePreview"></div>
                                </div>
                                
                                <!-- Social Media Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class='bx bx-share-alt'></i>
                                        <span>Social Media (Optional)</span>
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Facebook</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxl-facebook'></i></span>
                                                <input type="url" class="form-control" name="facebook_url" placeholder="facebook.com/username">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">LinkedIn</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxl-linkedin'></i></span>
                                                <input type="url" class="form-control" name="linkedin_url" placeholder="linkedin.com/in/username">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Instagram</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxl-instagram'></i></span>
                                                <input type="url" class="form-control" name="instagram_url" placeholder="instagram.com/username">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Twitter / X</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxl-twitter'></i></span>
                                                <input type="url" class="form-control" name="twitter_url" placeholder="twitter.com/username">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-card mb-4">
                            <div class="card-header-custom">
                                <h5>Settings</h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="mb-4">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status" required>
                                        <option value="published">Published</option>
                                        <option value="draft">Draft</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                    <small class="text-muted">Control speaker visibility</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Generation <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="generation" value="7" required min="1" max="20">
                                    <small class="text-muted">Current: Generation 7</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Event Year <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="event_year" value="2026" required min="2020" max="2030">
                                </div>
                                
                                <div>
                                    <label class="form-label">Display Order</label>
                                    <input type="number" class="form-control" name="display_order" value="0" min="0">
                                    <small class="text-muted">Lower numbers appear first (0 = default)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary" style="flex: 1;">
                                <i class='bx bx-check me-1'></i> Create Speaker
                            </button>
                            <a href="admin/speakers/manage.php" class="btn btn-label-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>
    
    <script>
        // Word counter
        const bioField = document.getElementById('bioField');
        const wordCounter = document.getElementById('wordCounter');
        const maxWords = 50;
        
        bioField.addEventListener('input', function() {
            const text = this.value.trim();
            const words = text ? text.split(/\s+/).length : 0;
            
            wordCounter.textContent = `${words} / ${maxWords} words`;
            
            if (words > maxWords) {
                wordCounter.classList.add('error');
                wordCounter.classList.remove('warning');
            } else if (words > 40) {
                wordCounter.classList.add('warning');
                wordCounter.classList.remove('error');
            } else {
                wordCounter.classList.remove('error', 'warning');
            }
        });
        
        // Image upload
        const imageInput = document.getElementById('imageInput');
        const uploadArea = document.querySelector('.image-upload-area');
        const imagePreview = document.getElementById('imagePreview');
        
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                uploadArea.classList.add('has-file');
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert-dismissible').forEach(alert => {
                alert.style.transition = 'opacity 0.3s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
<?php $con->close(); ?>
