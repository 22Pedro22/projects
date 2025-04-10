#include <stdio.h>
#include <string.h>
#include <stdbool.h>

void VerClientes();

void ClientesDefinidos();
void ClientesIndefinidos();

void AdicionarClientes();
void RemoverClientes();

int main(){
	unsigned short int escolha;
	while(true){
		puts("------------------");
		puts("SELECIONE UMA OPÇÃO");
		puts("-------------------");
		puts("[1] Ver Clientes");
		puts("[2] Adicionar Clientes");
		puts("[3] Remover Clientes");
		puts("[0] Sair");
		printf("> ");
		scanf("%hu" , &escolha);
		switch (escolha){
			case 1:
				VerClientes();
				break;
			case 2:
				AdicionarClientes();
				break;
			case 3:
				RemoverClientes();
				break;
			case 0:
				puts("Programa encerrado.");
				return 0;
			default:
				puts("Opção inválida, tente novamente:\n");
				break;
		}
	}
}

void VerClientes(){
	puts("Olá Mundo!\n");
}

void AdicionarClientes(){
	unsigned short int escolha;
	while(true){
		puts("-------------------------------------------");
		puts("[1] Adicionar número definido de clientes");
		puts("[2] Adicionar número indefinido de clientes");
		puts("[0] Menu");
		puts("-------------------------------------------");
		printf("> ");
		scanf("%hu" , &escolha);
		switch (escolha){
			case 1:
				ClientesDefinidos();
				break;
			case 2:
				ClientesIndefinidos();
				break;
			case 0:
				return;
			default:
				puts("Opção inválida, tente novamente:");
				break;
		}
	}

}

void RemoverClientes(){
	puts("Olá Mundo!\n");
}

void ClientesDefinidos(){
	char nome[20];
	unsigned cpf;
	unsigned numero;
	printf("Selecione o número de clientes a serem adicionados: ");
	scanf("%u" , &numero);
	for(unsigned i = 1; i <= numero; i++){
		printf("Nome do cliente %u: " , i);
		scanf("%s" , nome);
		printf("CPF no cliente %u: " , i);
		scanf("%u" , &cpf);
	}
	puts("Todos os clientes foram adicionados!");
}

void ClientesIndefinidos(){
	char nome[20];
	unsigned cpf;
	unsigned numero = 1;
	char sair[4];
	while(true){
		printf("Nome do cliente %u: " , numero);
		scanf("%s" , nome);
		printf("CPF do cliente %u: " ,  numero);
		scanf("%u" , &cpf);
		numero++;
		printf("Deseja sair? [sim/nao]: ");
		scanf("%s" , sair);
		if(strcasecmp(sair , "sim") == 0){
			return;
		}
	}
}
