import socket

client = socket.socket(socket.AF_INET , socket.SOCK_STREAM)

client.connect(("127.0.0.1" , 1223))

try:
    while True:
        msg = input('> ')
        client.send((msg + '\n').encode())
        server_msg = client.recv(1024).decode()
        print(f'\033[1mServer\033[m: {server_msg}')
except Exception as error:
    print(error)
