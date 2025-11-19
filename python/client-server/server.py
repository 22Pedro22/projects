import socket

server = socket.socket(socket.AF_INET , socket.SOCK_STREAM)

server.bind(("0.0.0.0" , 1223))
server.listen(5)
print('Listening...')
client_socket , client_adress = server.accept()
print(f'Receiving from: {client_adress[0]}')

try:
    while True:
        msg_client = client_socket.recv(1024).decode()
        print(f'\033[1m{client_adress[0]}\033[m : {msg_client}')
        msg = input('> ')
        client_socket.send(msg.encode())
        if msg == '!sair':
            end = 'conexão encerrada'
            client_socket.send(end.encode())
            server.close()
            exit()

except Exception as error:
    print(error)
    server.close()
