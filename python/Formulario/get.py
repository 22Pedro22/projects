from selenium import webdriver
from selenium.webdriver.common.by import By
from time import sleep

print("PREENCHA OS CAMPOS:")

tema_da_aula = input("Tema da aula: ")
observacoes = input("Observações: ")
procedimentos_metodologicos = input("Procedimentos Metodológicos: ")

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
                  "AppleWebKit/537.36 (KHTML, like Gecko) "
                  "Chrome/116.0.5845.188 Safari/537.36"
}

navegador = webdriver.Firefox()
navegador.get("https://juazeiro.gteducacao.com.br/#/login")

navegador.find_element(By.CSS_SELECTOR , '[formcontrolname="login"]').send_keys("62195255315")
navegador.find_element(By.CSS_SELECTOR , '[formcontrolname="password"]').send_keys("123456")

navegador.find_element(By.CSS_SELECTOR , 'button.btn.btn-acessar').click()

sleep(5)

navegador.get("https://juazeiro.gteducacao.com.br/#/sistema/professor/turmas_view/10357")

sleep(3)

navegador.find_element(By.CLASS_NAME , 'clearfix').click()

sleep(5)

navegador.find_element(By.CSS_SELECTOR , "button.btn.btn-primary.btn-add").click()

sleep(3)

navegador.find_element(By.CSS_SELECTOR , "[formcontrolname='plano_data']").send_keys(11112025)

navegador.find_element(By.CSS_SELECTOR , "[formcontrolname='plano_tema']").send_keys(tema_da_aula)

navegador.find_element(By.CSS_SELECTOR , "[formcontrolname='plano_observacao']").send_keys(observacoes)

navegador.find_element(By.CSS_SELECTOR , "[ng-reflect-name='procedimentos_metodologicos']").send_keys(procedimentos_metodologicos)


