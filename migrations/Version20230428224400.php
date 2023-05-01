<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230428224400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Tabelas criadas com sucesso!';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(14) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contato (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, idPessoa INT NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_idPessoa FOREIGN KEY (idPessoa) REFERENCES pessoa (id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE contato');
        $this->addSql('DROP TABLE pessoa');
    }
}
