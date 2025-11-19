from selenium import webdriver
from selenium.webdriver.common.by import By
from time import sleep
from random import choice

emails = ["pedro@gmail.com" , "natan@gmail.com" , "elis@gmail.com" , "neto@gmail.com"]
senhas = ["123" , "senha123"  , "123senha123" , "12334556789" , "987654321"]

navegador = webdriver.Firefox()
navegador.get("http://localhost:1010")

print("\033[1;37mCOMPLENTANDO FORMULARIO...\033[m")

while True:

    email = choice(emails)
    senha = choice(senhas)

    navegador.find_element(By.NAME , "email").send_keys(email)
    navegador.find_element(By.NAME , "senha").send_keys(senha)

    navegador.find_element(By.NAME , "enviar").click()

    
    print(email)
    print(senha)

    sleep(3)
