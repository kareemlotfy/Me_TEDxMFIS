import os
from PIL import Image

# Use the appropriate resampling filter based on Pillow version
try:
    RESAMPLING_FILTER = Image.Resampling.LANCZOS
except AttributeError:
    RESAMPLING_FILTER = Image.LANCZOS # Fallback for older Pillow versions

# --- Core Functions ---

def resize_image(image: Image.Image, max_width: int, max_height: int) -> Image.Image:
    """
    Resizes an image proportionally to fit within the max_width and max_height.
    It expects a PIL Image object as input.
    """
    width, height = image.size
    
    # Only resize if the image exceeds the maximum dimensions
    if width > max_width or height > height:
        ratio = min(max_width / width, max_height / height)
        new_width = int(width * ratio)
        new_height = int(height * ratio)
        # Use the defined high-quality resampling filter
        return image.resize((new_width, new_height), RESAMPLING_FILTER)
        
    return image


def resize_canvas(image: Image.Image, new_width: int, new_height: int, color=(255, 255, 255, 0)) -> Image.Image:
    """
    Pads an image to a specific canvas size (new_width x new_height) with 
#     a transparent background (color=(255, 255, 255, 0) for RGBA).
    """
    width, height = image.size
    
    # Ensure the output image has an alpha channel (RGBA) to support the padding color
    # and potential future transparency needs.
    result = Image.new('RGBA', (new_width, new_height), color) 
    
    # Calculate paste position to center the original image
    # Note: We use image.convert('RGBA') to ensure we have a valid mask if the 
    # original image didn't have one (like a standard JPEG/WEBP).
    img_rgba = image.convert('RGBA')
    
    result.paste(img_rgba, ((new_width - width) // 2, (new_height - height) // 2), img_rgba)
    return result


def process_images(input_folder, output_folder, source_ext='webp', target_ext='webp'):
    """
    Iterates through original files, performs local resizing and canvas padding, 
    and saves the final image.
    """
    if not os.path.exists(output_folder):
        os.makedirs(output_folder)
    
    # Process images from (61) to (77)
    for i in range(61, 78): 
        # Construct the expected input filename based on the source extension
        input_filename = f'sponser  ({i}).{source_ext}'
        image_path = os.path.join(input_folder, input_filename)
        
        # Construct the output filename based on the target extension
        output_filename = f'sponser  ({i}).{target_ext}' 
        output_path = os.path.join(output_folder, output_filename)

        if os.path.exists(image_path):
            try:
                # Step 1: Open the original image
                with Image.open(image_path) as img:
                    
                    # Convert image to RGB if necessary for a solid background 
                    # before resizing and padding. If the source image is already
                    # transparent (e.g., from the remove_bg script), it will
                    # maintain that transparency through the process.
                    
                    # Step 2: Resize the image content to fit within 240x136 pixels
                    resized_image = resize_image(img.copy(), 240, 136)
                    
                    # Step 3: Resize the canvas to exactly 240x136 pixels, centering the image
                    # Note: Default background color is white.
                    final_image = resize_canvas(resized_image, 240, 136)
                    
                    # Step 4: Save the final image in the desired format
                    final_image.save(output_path, format=target_ext.upper())
                    
                    print(f' Successfully processed {input_filename} and saved as {output_path}')
            
            except Exception as e:
                print(f' Error processing {input_filename}: {e}')
        else:
            print(f'Skipping {input_filename}: File not found in input folder.')

if __name__ == '__main__':
    # --- Configuration ---
    # The new input folder is the one containing your original, non-transparent images.
    input_folder = r'G:\xampp\htdocs\TEDxManaratAlfaroukSchool\images\snew\old'
    output_folder = r'G:\xampp\htdocs\TEDxManaratAlfaroukSchool\images\snew\edited'
    
    # --- IMPORTANT SETTINGS ---
    # Specify the original file extension (e.g., 'jpg', 'webp', 'png')
    SOURCE_EXTENSION = 'webp' 
    # Specify the desired output file extension (e.g., 'webp', 'jpg', 'png')
    TARGET_EXTENSION = 'webp'
    # --------------------------
    
    print("--- Starting Image Processing (Resize/Canvas) from original files ---")
    process_images(input_folder, output_folder, SOURCE_EXTENSION, TARGET_EXTENSION)
    print("--- All image processing complete. ---")