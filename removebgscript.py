import os
import requests
from io import BytesIO
from PIL import Image
import time

# Your remove.bg API key
REMOVE_BG_API_KEY = 'Do3NhmRtaA29cMJVad7Rv38k'

def remove_bg(image_path):
    with open(image_path, 'rb') as file:
        response = requests.post(
            'https://api.remove.bg/v1.0/removebg',
            files={'image_file': file},
            data={'size': 'auto'},
            headers={'X-Api-Key': REMOVE_BG_API_KEY},
        )
    if response.status_code == requests.codes.ok:
        return Image.open(BytesIO(response.content))
    else:
        print(f"Error: {response.status_code} - {response.text}")
        return None

def process_images(input_folder, output_folder):
    if not os.path.exists(output_folder):
        os.makedirs(output_folder)
    
    files = sorted([f for f in os.listdir(input_folder) if f.lower().endswith(('.png', '.jpg', '.jpeg', '.webp'))])
    
    for i, filename in enumerate(files, start=1):
        image_path = os.path.join(input_folder, filename)
        print(f"Processing {filename}...")
        
        try:
            image_no_bg = remove_bg(image_path)
            if image_no_bg:
                output_path = os.path.join(output_folder, os.path.splitext(filename)[0] + '.webp')
                image_no_bg.save(output_path, format='WEBP')
                print(f" Saved: {output_path}")
        except Exception as e:
            print(f" Error processing {filename}: {e}")
        
        # Wait 60 sec after every 10 images
        if i % 10 == 0:
            print(" Processed 10 images, waiting 60 seconds...")
            time.sleep(60)

if __name__ == '__main__':
    input_folder = r'C:\Users\karee\xampp\htdocs\Me_TEDxMFIS\images\sponsers'   # ← change this
    output_folder = r'C:\Users\karee\xampp\htdocs\Me_TEDxMFIS\images\new sponsors' # ← change this
    process_images(input_folder, output_folder)
