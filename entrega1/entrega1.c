#include <stdio.h>
#include <string.h>
#include <stdbool.h>

void VerClientes();
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
	puts("-------------")
	char nome[20];
	unsigned cpf;
	printf("Nome do cliente: ");
	scanf("%s" , nome);
	printf("CPF do cliente: ");
	scanf("%u" , &cpf);
	struct clientes{char nome[20]; unsigned cpf;};
	struct clientes cliente1;
	strcpy(cliente1.nome , nome);
	cliente1.cpf = cpf;
	printf("Cliente %s com o cpf %u adicionado!\n" , cliente1.nome , cliente1.cpf);
}

void RemoverClientes(){
	puts("Olá Mundo!\n");
}
