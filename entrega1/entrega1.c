#include <stdio.h>
#include <string.h>
#include <stdbool.h>

void VerClientes();

void ClientesDefinidos();
void ClientesIndefinidos();

void AdicionarClientes();
void RemoverClientes();

struct clientes {char nome[20]; unsigned cpf; char prioridade[10];};
struct clientes fila[100];

int fim = 0;

int main(){
	unsigned short int escolha;
	while(true){
		puts("-------------------");
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
	if(fim == 0){
		puts("Nenhum cliente definido");
	}
	else{
		for(int i = 0; i < fim; i++){
			puts("----------------------------");
			printf("ID: %d\n" , i + 1);
			printf("Nome: %s\n" , fila[i].nome);
			printf("CPF: %u\n" , fila[i].cpf);
			printf("Prioridade: %s\n" , fila[i].prioridade);
			puts("----------------------------");
		}
	}
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
	int id;
	if(fim == 0){
		puts("Nenhum cliente adicionado");
	}
	else{	
		for(int i = 0; i < fim; i++){
			puts("----------------------------");
			printf("ID: %d\n" , i + 1);
			printf("Nome: %s\n" , fila[i].nome);
			printf("CPF: %u\n" , fila[i].cpf);
			printf("Prioridade: %s\n" , fila[i].prioridade);
			puts("----------------------------");
		}

		printf("ID do usuário a ser removido: ");
		scanf("%d" , &id);
		for(int i = id - 1; i < fim - 1; i++){
			fila[i] = fila[i + 1];
		}
		fim--;

	}
}

void ClientesDefinidos(){
	char nome[20];
	unsigned cpf;
	unsigned numero;
	char prioridade[10];
	printf("Selecione o número de clientes a serem adicionados: ");
	scanf("%u" , &numero);
	for(int i = 1; i <= numero; i++){
		printf("Nome do cliente %d: " , i);
		scanf("%s" , nome);
		printf("CPF no cliente %d: " , i);
		scanf("%u" , &cpf);
		printf("Prioridade do cliente %d (alta/media/baixa): " , i);
		scanf("%s" , prioridade);
		strcpy(fila[fim].nome , nome);
		fila[fim].cpf = cpf;
		strcpy(fila[fim].prioridade , prioridade);
		fim++;
	}
	puts("Todos os clientes foram adicionados!");
}

void ClientesIndefinidos(){
	char nome[20];
	unsigned cpf;
	unsigned numero = 1;
	char prioridade[10];
	char sair[4];
	while(true){
		printf("Nome do cliente %u: " , numero);
		scanf("%s" , nome);
		printf("CPF do cliente %u: " ,  numero);
		scanf("%u" , &cpf);
		printf("Prioridade do cliente %u (alta/media/baixa): " , numero);
		scanf("%s" , prioridade);
		numero++;
		strcpy(fila[fim].nome , nome);
		fila[fim].cpf = cpf;
		strcpy(fila[fim].prioridade , prioridade);
		fim++;
		printf("Deseja sair? [sim/nao]: ");
		scanf("%s" , sair);
		if(strcasecmp(sair , "sim") == 0){
			return;
		}
	}
}
