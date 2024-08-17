from flask import Flask, render_template, request, send_file
import subprocess
import os

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/generate', methods=['POST'])
def generate_clip():
    youtube_url = request.form.get('youtube_url')
    
    # Example: Generate a clip using yt-dlp and ffmpeg
    download_command = ["yt-dlp", youtube_url, "-o", "video.mp4"]
    subprocess.run(download_command)

    # Clip the video
    clip_command = ["ffmpeg", "-i", "video.mp4", "-ss", "00:00:30", "-t", "00:00:10", "-c", "copy", "clip.mp4"]
    subprocess.run(clip_command)

    return send_file("clip.mp4", as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True)
