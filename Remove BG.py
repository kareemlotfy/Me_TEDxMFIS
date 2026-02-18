# remove_bg_script.py

import os
import requests
import time

# NOTE: For security, you should load this from an environment variable!
REMOVE_BG_API_KEY = 'TxGjmQFfmuywbxATnWFvi7Pg'

def remove_background_and_save(input_folder, temp_folder):
    """
    Iterates through image files, calls the remove.bg API, and saves the 
    result as a transparent PNG in a temporary folder.
    """
    if not os.path.exists(temp_folder):
        os.makedirs(temp_folder)
    
    processed_count = 0
    # Process images from (61) to (77)
    for i in range(61, 78): 
        # Assuming the original images are named 'sponser (i).webp'
        # Adjust the extension if the source files are JPGs, PNGs, etc.
        input_filename = f'sponser  ({i}).webp' 
        image_path = os.path.join(input_folder, input_filename)
        output_filename = f'sponser  ({i}).webp' # Use PNG for transparency
        output_path = os.path.join(temp_folder, output_filename)

        if os.path.exists(image_path):
            print(f"--- Removing background from {input_filename}...")
            try:
                # 1. Call the remove.bg API
                with open(image_path, 'rb') as file:
                    response = requests.post(
                        'https://api.remove.bg/v1.0/removebg',
                        files={'image_file': file},
                        # Request the output format as PNG to preserve the alpha channel
                        data={'size': 'auto', 'format': 'webp'}, 
                        headers={'X-Api-Key': REMOVE_BG_API_KEY},
                        timeout=30 
                    )
                
                response.raise_for_status() # Check for HTTP errors
                
                # Check for specific API error (e.g., quota exceeded)
                if response.headers.get('x-api-error'):
                    raise requests.HTTPError(response.text)

                # 2. Save the resulting transparent image (PNG format)
                with open(output_path, 'wb') as f:
                    f.write(response.content)
                
                print(f' Successfully saved transparent image to {output_path}')
                processed_count += 1
                
                # 3. Pause every 10 successful API calls to manage rate limits
                if processed_count > 0 and processed_count % 10 == 0:
                    print('Processed 10 images, waiting for 60 seconds to manage API rate limits...')
                    time.sleep(60)
            
            except requests.exceptions.RequestException as e:
                print(f' API Error processing {input_filename}: {e}')
                if 'response' in locals() and response.text:
                    print(f'API Response details: {response.text}')
            except Exception as e:
                print(f' Unexpected Error processing {input_filename}: {e}')
        else:
            print(f'Skipping {input_filename}: Not found in input folder.')

if __name__ == '__main__':
    # --- Configuration ---
    input_folder = r'G:\xampp\htdocs\TEDxManaratAlfaroukSchool\images\snew\edited\to remove bg'
    # Use a separate temporary folder for the API output
    temp_folder = r'G:\xampp\htdocs\TEDxManaratAlfaroukSchool\images\snew\edited\to remove bg\removed'
    # ---------------------
    
    print("--- Starting Background Removal Process ---")
    remove_background_and_save(input_folder, temp_folder)
    print("--- Background Removal Complete. Run the Image Processing script next. ---")